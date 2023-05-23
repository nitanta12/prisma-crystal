<!-- Program Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('program_name', 'Program Name:') !!}
    {!! Form::text('program_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Vendor Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vendor_id', 'Vendor:') !!}
    <select name="vendor_id" class="form-control select2" required="">
    	<option value="">Select</option>
    	@foreach($vendors as $v)
    		<option value="{{$v->id}}" @if(isset($program)) @if($program->vendor_id == $v->id) selected  @endif   @endif>{{$v->vendor_name}}({{$v->vendor_type}})</option>
    	@endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.programs.index') !!}" class="btn btn-default">Cancel</a>
</div>
