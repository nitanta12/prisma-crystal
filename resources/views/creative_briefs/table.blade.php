<div class="table-responsive">
    <table class="table" id="creativeBriefs-table">
        <thead>
            <tr>
                <th>Campaign Id</th>
                <th>Creative user</th>
                <th>Creative Brief Name</th>
                <th>Creative Brief File</th>
                <th>Creative Brief Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($creativeBriefs as $creativeBrief)
            <tr>
                <td>{!! $creativeBrief->campaign_id !!}</td>
                <td>{!! $creativeBrief->users->name !!}</td>
                <td>{!! $creativeBrief->creative_brief_name !!}</td>
                <td><a target="_blank" href="{{asset('creative_brief'.'/'.$creativeBrief->creative_brief_file)}}">{!! $creativeBrief->creative_brief_file !!}</a></td>
                <td>{!! $creativeBrief->creative_brief_description !!}</td>
                <td>
                    @if(Auth::user()->roles[0]->title != 'Executive')
                    {!! Form::open(['route' => ['admin.creativeBriefs.destroy', $creativeBrief->id], 'method' => 'delete']) !!}
                    <input type="hidden" name="campaign_id" value="{{$creativeBrief->campaign_id}}">
                    <div class='btn-group'>
                        <a href="{!! route('admin.creativeBriefs.show', [$creativeBrief->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('admin.creativeBriefs.edit', [$creativeBrief->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
