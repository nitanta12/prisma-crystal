
<!-- Creative Brief Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('creative_brief_name', 'Creative Brief Name:') !!}
    {!! Form::text('creative_brief_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Creative Brief File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('creative_brief_file', 'Creative Brief File:') !!}
    {!! Form::file('creative_brief_file') !!}
</div>
<div class="form-group col-sm-6">
<label>Assign to Creative:</label>
<select class="form-control select2" name="creative">
	@foreach($creatives as $creative)
	<option value="{{$creative['id']}}">{{$creative['name']}}</option>
	@endforeach
</select>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('creative_brief_description', 'Creative Brief Description:') !!}
    {!! Form::textarea('creative_brief_description', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>
