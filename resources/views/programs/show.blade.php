@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        
            Program
        
    </div>
    <div class="card-body">
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{URL::TO('/')}}/admin/programs/update_rate/{{$program->id}}" method="post">
                    {{csrf_field()}}
                    
                        <table class="table">
                            <thead>
                                <th>Position</th>
                                <th>Per day Rate</th>
                                <th>Per minute Rate</th>
                                <th>Per spot Rate</th>
                            </thead>
                            
                            <tbody>
                                @foreach($program->rates as $pr)
                                <tr>
                                    <td>
                                        {{$pr->position}}
                                    </td>
                                    <td>
                                        <input type="number" name="rate[{{$pr->id}}][day]" class="form-control" step="0.01" placeholder="Rate " required="" value="{{$pr->rate_per_day}}">
                                    </td>
                                    <td>
                                        <input type="number" name="rate[{{$pr->id}}][minute]" class="form-control" step="0.01" placeholder="Rate " required="" value="{{$pr->rate_per_minute}}">
                                    </td>

                                    <td>
                                        <input type="number" name="rate[{{$pr->id}}][spot]" class="form-control" step="0.01" placeholder="Rate " required="" value="{{$pr->rate_per_spot}}">
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                            
                        </table>
                   

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary pull-right" value="Save">
                    </div>

                 </form>
                    <a href="{!! route('admin.programs.index') !!}" class="btn btn-default">Back</a>
               
            </div>
        </div>
    </div>
</div>
@endsection
    