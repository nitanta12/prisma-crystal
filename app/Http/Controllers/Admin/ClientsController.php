<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Vendors;
use App\User;
use App\Models\ClientUsers;
use Flash;
use Response;
use App\Models\Clients;

class ClientsController extends AppBaseController
{
    /** @var  ClientsRepository */
    private $clientsRepository;

    public function __construct(ClientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
    }

    /**
     * Display a listing of the Clients.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $clients = Clients::paginate(10);

        return view('clients.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new Clients.
     *
     * @return Response
     */
    public function create()
    {
        $users =  User::whereHas('roles', function($q){$q->whereIn('title', ['CS']);})->get();

        return view('clients.create',compact('users'));
    }

    /**
     * Store a newly created Clients in storage.
     *
     * @param CreateClientsRequest $request
     *
     * @return Response
     */
    public function store(CreateClientsRequest $request)
    {
        $input = $request->all();

        $users = $input['user_id'];

        unset($input['user_id']);

        $clients = $this->clientsRepository->create($input);

        //dd($clients);

        $this->update_client_users($users,$clients->id);

        Flash::success('Clients saved successfully.');

        return redirect(route('admin.clients.index'));
    }

    /**
     * Display the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('admin.clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clients = $this->clientsRepository->find($id);

        $editusers = ClientUsers::where('client_id',$id)->pluck('user_id')->toArray();


        $users = User::whereHas('roles', function($q){$q->whereIn('title', ['CS']);})->get();


        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('admin.clients.index'));
        }

        return view('clients.edit',compact('editusers','users'))->with('clients', $clients);
    }

    /**
     * Update the specified Clients in storage.
     *
     * @param int $id
     * @param UpdateClientsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientsRequest $request)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }
        $request  = $request->all();

        $users = $request['user_id'];

        unset($request['user_id']);

        $this->update_client_users($users,$id);

        $clients = $this->clientsRepository->update($request, $id);

        Flash::success('Clients updated successfully.');

        return redirect(route('admin.clients.index'));
    }

    /**
     * Remove the specified Clients from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        $checkCampaign = Campaign::where('client_id',$id)->get();

        if($checkCampaign->count() == 0)
        {
            if (empty($clients)) {
                Flash::error('Clients not found');

                return redirect(route('admin.clients.index'));
            }

            $this->clientsRepository->delete($id);
            ClientUsers::where('client_id',$id)->delete();

            Flash::success('Clients deleted successfully.');
        }
        else
        {
            Flash::error('Client is assigned to campaign, Cannot be deleted');
        }

        

        return redirect(route('admin.clients.index'));
    }

    public function update_client_users($user_id,$client_id)
    {

        ClientUsers::where('client_id',$client_id)->delete();

        foreach($user_id as $uid)
        {
            $ins['client_id'] = $client_id;
            $ins['user_id'] = $uid;
            ClientUsers::insert($ins);
        }

    }
}
