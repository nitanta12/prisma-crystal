<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover datatable" id="clients-table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Client Name</th>
                <th>Client Phone</th>
                <th>Client Address</th>
                
                <th>Client Brand</th>
                <th>Client Representative</th>
                <th>Client Email</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clients as $key=>$clients)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{!! $clients->client_name !!}</td>
                <td>{!! $clients->client_phone !!}</td>
                <td>{!! $clients->client_address !!}</td>

                <td>{!! $clients->client_brand !!}</td>
                <td>{!! $clients->representative !!}</td>
                
                <td>{!! $clients->client_email !!}</td>
                <td>
                    {!! Form::open(['route' => ['admin.clients.destroy', $clients->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.clients.show', [$clients->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('admin.clients.edit', [$clients->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
