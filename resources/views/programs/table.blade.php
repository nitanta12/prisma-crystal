<div class="table-responsive">
    <table class="table" id="programs-table">
        <thead>
            <tr>
                <th>Program Name</th>
                <th>Vendor Name</th>
                <th>Vendor Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($programs as $program)
            <tr>
                <td>{!! $program->program_name !!}</td>
                <td>{!! $program->vendors->vendor_name !!}</td>
                <td>{!! $program->vendors->vendor_type !!}</td>
                <td>
                    {!! Form::open(['route' => ['admin.programs.destroy', $program->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.programs.show', [$program->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye"></i> Rates</a>
                        <a href="{!! route('admin.programs.edit', [$program->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
