<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Repositories\ProgramRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Vendors;
use App\Models\Program;
use App\Models\ProgramRate;
use Flash;
use Response;

class ProgramController extends AppBaseController
{
    /** @var  ProgramRepository */
    private $programRepository;

    public function __construct(ProgramRepository $programRepo)
    {
        $this->programRepository = $programRepo;
    }

    /**
     * Display a listing of the Program.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $programs = Program::paginate(10);

        return view('programs.index')
            ->with('programs', $programs);
    }

    /**
     * Show the form for creating a new Program.
     *
     * @return Response
     */
    public function create()
    {
        $vendors = Vendors::where('vendor_type','=','tv')->orWhere('vendor_type','=','radio')->get();



        return view('programs.create',compact('vendors'));
    }

    /**
     * Store a newly created Program in storage.
     *
     * @param CreateProgramRequest $request
     *
     * @return Response
     */
    public function store(CreateProgramRequest $request)
    {
        $input = $request->all();

        $program = $this->programRepository->create($input);

        $pr_array = [];
        $pr_array['program_id'] = $program->id;
        $position = ['Before','First Break','Headline Break','Second Break','In between'];
        foreach($position as $p)
        {
            $pr_array['position'] = $p;
            $pr_array['rate'] = 0;

            ProgramRate::create($pr_array);
        }

        Flash::success('Program saved successfully.');

        return redirect(route('admin.programs.index'));
    }

    /**
     * Display the specified Program.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $program = $this->programRepository->find($id);

        if (empty($program)) {
            Flash::error('Program not found');

            return redirect(route('admin.sprograms.index'));
        }

        return view('programs.show')->with('program', $program);
    }

    /**
     * Show the form for editing the specified Program.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $program = $this->programRepository->find($id);

        $vendors = Vendors::where('vendor_type','=','tv')->orWhere('vendor_type','=','radio')->get();


        if (empty($program)) {
            Flash::error('Program not found');

            return redirect(route('admin.programs.index'));
        }

        return view('programs.edit',compact('vendors'))->with('program', $program);
    }

    /**
     * Update the specified Program in storage.
     *
     * @param int $id
     * @param UpdateProgramRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProgramRequest $request)
    {
        $program = $this->programRepository->find($id);

        if (empty($program)) {
            Flash::error('Program not found');

            return redirect(route('admin.programs.index'));
        }

        $program = $this->programRepository->update($request->all(), $id);

        Flash::success('Program updated successfully.');

        return redirect(route('admin.programs.index'));
    }

    /**
     * Remove the specified Program from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $program = $this->programRepository->find($id);

        if (empty($program)) {
            Flash::error('Program not found');

            return redirect(route('admin.programs.index'));
        }
        ProgramRate::where('program_id',$id)->delete();
        $this->programRepository->delete($id);

        Flash::success('Program deleted successfully.');

        return redirect(route('admin.programs.index'));
    }

    public function update_rate(Request $request,$program_id)
    {
        $request = $request->all();

        foreach($request['rate'] as $key=>$rr)
        {
            $pr = ProgramRate::find($key);
            $pr->rate_per_day = $rr['day'];
            $pr->rate_per_minute = $rr['minute'];
            $pr->rate_per_spot = $rr['spot'];
            $pr->save();
        }
        Flash::success('Rates updated successfully.');
        return redirect('/admin/programs/' . $program_id);
    }

    public function get_program_by_vendor_ajax($vendor_id)
    {
        $programs = Program::where('vendor_id',$vendor_id)->get();
        $html = '';
        foreach($programs as $p)
        {
            $html.='<option value='.$p->id.'>'. $p->program_name .'</option>';
        }

        echo $html;
    }

    public function get_position_by_program_ajax($program_id)
    {
        $rates = ProgramRate::where('program_id',$program_id)->get();

         $html = '';
        foreach($rates as $p)
        {
            $html.='<option value='.$p->id.'>'. $p->position .'</option>';
        }

        echo $html;

    }

     public function get_rate_by_position_ajax($id)
    {
        $rates = ProgramRate::find($id);
        $html = '';
        if($rates)
        {
         $html.= '<div class="form-group rate_per_minute" style="display:none">';
         $html.='<label>Rate Per Minute</label>';
         $html.='<input type="number" name="rate_per_minute" class="form-control" step="0.01" value='.$rates->rate_per_minute.'>';
         $html.='</div>';

         $html.= '<div class="form-group rate_per_day" style="display:none">';
         $html.='<label>Rate Per Day</label>';
         $html.='<input type="number" name="rate_per_day" class="form-control" step="0.01" value='.$rates->rate_per_day.'>';
         $html.='</div>';

         $html.= '<div class="form-group rate_per_spot" style="display:none">';
         $html.='<label>Rate Per Spot</label>';
         $html.='<input type="number" name="rate_per_spot" class="form-control" step="0.01" value='.$rates->rate_per_spot.'>';
         $html.='</div>';


         echo $html;
        }
        

    }


}
