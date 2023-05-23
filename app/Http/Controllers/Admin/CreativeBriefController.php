<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCreativeBriefRequest;
use App\Http\Requests\UpdateCreativeBriefRequest;
use App\Repositories\CreativeBriefRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\CreativeBrief;
use Flash;
use Response;
use Auth;
use App\User;

class CreativeBriefController extends AppBaseController
{
    /** @var  CreativeBriefRepository */
    private $creativeBriefRepository;

    public function __construct(CreativeBriefRepository $creativeBriefRepo)
    {
        $this->creativeBriefRepository = $creativeBriefRepo;
    }

    /**
     * Display a listing of the CreativeBrief.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index($campaign_id)
    {

        $creativeBriefs = CreativeBrief::where('campaign_id',$campaign_id)->orderBy('created_at','DESC')->get();

        return view('creative_briefs.index',compact('campaign_id'))
            ->with('creativeBriefs', $creativeBriefs);
    }

    /**
     * Show the form for creating a new CreativeBrief.
     *
     * @return Response
     */
    public function create($campaign_id)
    {
        $creatives = User::with('roles')->whereHas('roles', function($query) {
                 $query->where('title', '=', 'Creative');
                })->get()->toArray();
        // dd($creatives);

        return view('creative_briefs.create',compact('campaign_id','creatives'));
    }

    /**
     * Store a newly created CreativeBrief in storage.
     *
     * @param CreateCreativeBriefRequest $request
     *
     * @return Response
     */
    public function store(CreateCreativeBriefRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'creative_brief_name' => 'required',
            'creative_brief_file' => 'required|mimes:jpeg,png,pdf,docx,doc,zip',
        ]);
        $campaign_id = $request->get('campaign_id');
        $file = $request->file('creative_brief_file');

        $filename = date('ymdhis').$file->getClientOriginalName();
        // dd($filename);
        if($filename!=''){
            $path = public_path()."/creative_brief";
            $file->move($path,$filename);
            $creativeBrief = new CreativeBrief;
            $creativeBrief->campaign_id = $campaign_id;
            $creativeBrief->creative_brief_name = $request->get('creative_brief_name');
            $creativeBrief->creative_user_id = $request->get('creative');
            $creativeBrief->creative_brief_description = $request->get('creative_brief_description');
            $creativeBrief->creative_brief_file = $filename;

            $creativeBrief->save();
        }else{
            Flash::error('Creative Brief saved failed.');
        }



        Flash::success('Creative Brief saved successfully.');

        return redirect(route('admin.creativeBriefs.index',[$campaign_id]));
    }

    /**
     * Display the specified CreativeBrief.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $creativeBrief = $this->creativeBriefRepository->find($id);

        if (empty($creativeBrief)) {
            Flash::error('Creative Brief not found');

            return redirect(route('creativeBriefs.index'));
        }

        return view('creative_briefs.show')->with('creativeBrief', $creativeBrief);
    }

    /**
     * Show the form for editing the specified CreativeBrief.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $creativeBrief = $this->creativeBriefRepository->find($id);

        if (empty($creativeBrief)) {
            Flash::error('Creative Brief not found');

            return redirect(route('creativeBriefs.index'));
        }
        $creatives = User::with('roles')->whereHas('roles', function($query) {
            $query->where('title', '=', 'Creative');
           })->get()->toArray();
        return view('creative_briefs.edit',compact('creatives'))->with('creativeBrief', $creativeBrief);
    }

    /**
     * Update the specified CreativeBrief in storage.
     *
     * @param int $id
     * @param UpdateCreativeBriefRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCreativeBriefRequest $request)
    {
        // dd($request->all());
        $creativeBrief = $this->creativeBriefRepository->find($id);
        $campaign_id = $request->get('campaign_id');
        if($request->file('creative_brief_file')){
            $file = $request->file('creative_brief_file');
            $filename = date('ymdhis').$file->getClientOriginalName();
            $path = public_path()."/creative_brief";
            $file->move($path,$filename);
            $creativeBrief->creative_brief_file = $filename;
        }

            $creativeBrief->campaign_id = $campaign_id;
            $creativeBrief->creative_brief_name = $request->get('creative_brief_name');
            $creativeBrief->creative_user_id = $request->get('creative');
            $creativeBrief->save();


        if (empty($creativeBrief)) {
            Flash::error('Creative Brief not found');

            return redirect(route('admin.creativeBriefs.index',[$campaign_id]));
        }
        Flash::success('Creative Brief updated successfully.');

        return redirect(route('admin.creativeBriefs.index',[$campaign_id]));
    }

    /**
     * Remove the specified CreativeBrief from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id,Request $r)
    {
        $creativeBrief = $this->creativeBriefRepository->find($id);

        if (empty($creativeBrief)) {
            Flash::error('Creative Brief not found');

            return redirect(route('creativeBriefs.index'));
        }

        $this->creativeBriefRepository->delete($id);

        Flash::success('Creative Brief deleted successfully.');

        return redirect(route('admin.creativeBriefs.index',[$r->get('campaign_id')]));
    }
}
