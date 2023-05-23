<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\AppBaseController;
use App\CreativeAds;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use App\User;

class CreativeAdsController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($campaign_id)
    {
        //
        $creative_ads = CreativeAds::all();
        return view('creative_ads.index',compact('campaign_id','creative_ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        if($request->file('file')){
            $file = $request->file('file');
            $fileName = date('ymshis').$file->getClientOriginalName();
            $path = public_path().'/creative_ads';
            $file->move($path,$fileName);
            $input['file'] = $fileName;
            $input['file_name'] = $request->get('file_name');
            $input['campaign_id'] = $request->get('campaign_id');

            $creative_ads = CreativeAds::create($input);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CreativeAds  $creativeAds
     * @return \Illuminate\Http\Response
     */
    public function show(CreativeAds $creativeAds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CreativeAds  $creativeAds
     * @return \Illuminate\Http\Response
     */
    public function edit(CreativeAds $creativeAds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CreativeAds  $creativeAds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CreativeAds $creativeAds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CreativeAds  $creativeAds
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $creative_ads = CreativeAds::find($id);
        $creative_ads->delete();
        return back();
    }
}
