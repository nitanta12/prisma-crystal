<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatevendorsRequest;
use App\Http\Requests\UpdatevendorsRequest;
use App\Repositories\vendorsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Vendors;
use Flash;
use Response;

class VendorsController extends AppBaseController
{
    /** @var  vendorsRepository */
    private $vendorsRepository;

    public function __construct(vendorsRepository $vendorsRepo)
    {
        $this->vendorsRepository = $vendorsRepo;
    }

    /**
     * Display a listing of the vendors.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {   

        $is_media = $request->get('is_media');
        $vendor_type = $request->get('vendor_type');

        $da = Vendors::where('vendor_name','!=','');

        if($is_media)
        {
            $da->where('is_media',$is_media);
        }
        if($vendor_type)
        {
            $da->where('vendor_type',$vendor_type);
        }
        
        $vendors =  $da->paginate(10);
  
        return view('vendors.index')
            ->with('vendors', $vendors->appends(request()->query()));
    }

    /**
     * Show the form for creating a new vendors.
     *
     * @return Response
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created vendors in storage.
     *
     * @param CreatevendorsRequest $request
     *
     * @return Response
     */
    public function store(CreatevendorsRequest $request)
    {
        $input = $request->all();

        $vendors = $this->vendorsRepository->create($input);

        Flash::success('Vendors saved successfully.');

        return redirect(route('admin.vendors.index'));
    }

    /**
     * Display the specified vendors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vendors = $this->vendorsRepository->find($id);

        if (empty($vendors)) {
            Flash::error('Vendors not found');

            return redirect(route('admin.vendors.index'));
        }

        return view('vendors.show')->with('vendors', $vendors);
    }

    /**
     * Show the form for editing the specified vendors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vendors = $this->vendorsRepository->find($id);

        if (empty($vendors)) {
            Flash::error('Vendors not found');

            return redirect(route('admin.vendors.index'));
        }

        return view('vendors.edit')->with('vendors', $vendors);
    }

    /**
     * Update the specified vendors in storage.
     *
     * @param int $id
     * @param UpdatevendorsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatevendorsRequest $request)
    {
        $vendors = $this->vendorsRepository->find($id);

        if (empty($vendors)) {
            Flash::error('Vendors not found');

            return redirect(route('admin.vendors.index'));
        }

        $vendors = $this->vendorsRepository->update($request->all(), $id);

        Flash::success('Vendors updated successfully.');

        return redirect(route('admin.vendors.index'));
    }

    /**
     * Remove the specified vendors from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vendors = $this->vendorsRepository->find($id);

        if (empty($vendors)) {
            Flash::error('Vendors not found');

            return redirect(route('admin.vendors.index'));
        }

        $this->vendorsRepository->delete($id);

        Flash::success('Vendors deleted successfully.');

        return redirect(route('admin.vendors.index'));
    }
}
