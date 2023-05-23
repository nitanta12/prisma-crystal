<div class="table-responsive">
    <table class="table" id="vendors-table">
        <thead>
            <tr>
                <th>Vendor Name</th>
                <th>Vendor Type</th>
                <th>Is Media</th>
                <th>Vendor Phone</th>
                <th>Vendor Address</th>
                <th>Vendor Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vendors as $vendors)
            <tr>
                <td>{!! $vendors->vendor_name !!}</td>
                <td>{!! $vendors->vendor_type !!}</td>
                <td>{!! $vendors->is_media !!}</td>
                <td>{!! $vendors->vendor_phone !!}</td>
                <td>{!! $vendors->vendor_address !!}</td>
                <td>{!! $vendors->vendor_description !!}</td>
                <td>
                    {!! Form::open(['route' => ['admin.vendors.destroy', $vendors->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.vendors.show', [$vendors->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
                        <a href="{!! route('admin.vendors.edit', [$vendors->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
