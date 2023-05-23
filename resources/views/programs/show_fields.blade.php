<!-- Program Name Field -->
<div class="form-group">
    {!! Form::label('program_name', 'Program Name:') !!}
    <p>{!! $program->program_name !!}</p>
</div>

<!-- Vendor Id Field -->
<div class="form-group">
    {!! Form::label('vendor_id', 'Vendor Id:') !!}
    <p>{!! $program->vendor_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $program->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $program->updated_at !!}</p>
</div>

