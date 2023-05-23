@extends('layouts.admin')
@section('content')
<div class="content">

        <div class="card">

        	<div class="card-header">
           		<h4 class="pull-left"> Welcome {{Auth::user()->name}}</h4>

           		<span class="pull-right badge badge-primary">Role : Creative</span>
        	</div>

        	<div class="card-body">
        		<h4>Creative Brief</h4>
                @include('flash::message')
                <table class="table">
                    <thead>

                        <th>Creative Brief Name</th>
                        <th>Creative Brief File</th>
                        <th>Creative Brief Description</th>

                    </thead>

                    <tbody>
                    @foreach($creative_briefs as $creative_brief)
                        <tr>
                            <td>{{$creative_brief->creative_brief_name}}</td>
                        <td><a target ="_blank" href="{{asset('creative_brief').'/'.$creative_brief->creative_brief_file}}">{{$creative_brief->creative_brief_file}}</a></td>
                            <td>{{$creative_brief->creative_brief_description}}</td>
                            <td></td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>

        	</div>

        </div>

</div>
@endsection
@section('scripts')
@parent

@endsection
