<div class="table-responsive">

    @php
        //dd($campaigns)
    @endphp

    <table class="table" id="campaigns-table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Campaign Name</th>
                <th>Client Brand</th>
                <th>Client Name</th>
                <th>Campaign Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($campaigns as $key=>$campaign)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{!! $campaign->campaign_name !!}</td>
                <td>{!! $campaign->client->client_brand !!}</td>
                <td>{!! $campaign->client->client_name !!}</td>
         
            <td>{!! $campaign->campaign_description !!}</td>
                <td>
                    {!! Form::open(['route' => ['admin.campaigns.destroy', $campaign->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.campaigns.show', [$campaign->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                       
                        @if(Auth::user()->roles[0]->title != 'Executive')
                        <a href="{!! route('admin.campaigns.edit', [$campaign->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endif
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
