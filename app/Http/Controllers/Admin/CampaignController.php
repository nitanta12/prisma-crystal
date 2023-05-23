<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Repositories\CampaignRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Clients;
use App\Models\AdvertisementCategory;
use App\Models\Templates;
use App\Models\CampaignCategory;
use App\Models\TemplateFields;
use App\Models\Tasks;
use App\Models\ClientUsers;
use Auth;
use Flash;
use Response;

class CampaignController extends AppBaseController
{
    /** @var  CampaignRepository */
    private $campaignRepository;

    public function __construct(CampaignRepository $campaignRepo)
    {
        $this->campaignRepository = $campaignRepo;
    }

    /**
     * Display a listing of the Campaign.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $client_id = $request->get('client_id');

        $role = Auth::user()->roles[0]->title;
        $user_id = Auth::user()->id;
        
        if($role == 'Admin' || $role == 'Executive')
        {
            $campaigns = Campaign::orderBy('created_at','DESC')->paginate(10);
        }
        else
        {
            if($client_id)
            {
                $campaigns = Campaign::where('user_id',$user_id)->where('client_id',$client_id)->orderBy('created_at','DESC')->paginate(10);
            }
            else
            {
                $campaigns = Campaign::where('user_id',$user_id)->orderBy('created_at','DESC')->paginate(10);
            }
        }


        return view('campaigns.index')
            ->with('campaigns', $campaigns);
    }

    /**
     * Show the form for creating a new Campaign.
     *
     * @return Response
     */
    public function create()
    {   
        $user_id = Auth::user()->id;
        $clients = ClientUsers::join('clients','client_users.client_id','=','clients.id')->where('client_users.user_id',$user_id)->get();

        return view('campaigns.create',compact('clients'));
    }

    /**
     * Store a newly created Campaign in storage.
     *
     * @param CreateCampaignRequest $request
     *
     * @return Response
     */
    public function store(CreateCampaignRequest $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        $input['user_id'] = $user_id;
        $campaign = $this->campaignRepository->create($input);

        Flash::success('Campaign saved successfully.');

        return redirect(route('admin.campaigns.index'));
    }

    /**
     * Display the specified Campaign.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $campaign = $this->campaignRepository->find($id);

       //dd($job_estimates);
        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('admin.campaigns.index'));
        }

        return view('campaigns.show')->with('campaign', $campaign);
    }

    /**
     * Show the form for editing the specified Campaign.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $campaign = $this->campaignRepository->find($id);

        $user_id = Auth::user()->id;
        $clients = ClientUsers::join('clients','client_users.client_id','=','clients.id')->where('client_users.user_id',$user_id)->get();

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('admin.campaigns.index'));
        }

        return view('campaigns.edit',compact('clients'))->with('campaign', $campaign);
    }

    /**
     * Update the specified Campaign in storage.
     *
     * @param int $id
     * @param UpdateCampaignRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampaignRequest $request)
    {
        $campaign = $this->campaignRepository->find($id);

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('admin.campaigns.index'));
        }

        $campaign = $this->campaignRepository->update($request->all(), $id);

        Flash::success('Campaign updated successfully.');

        return redirect(route('admin.campaigns.index'));
    }

    /**
     * Remove the specified Campaign from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $campaign = $this->campaignRepository->find($id);

        

        
            if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('admin.campaigns.index'));
            }

            $this->campaignRepository->delete($id);

            Flash::success('Campaign deleted successfully.');
        
        return redirect(route('admin.campaigns.index'));
    }
}
