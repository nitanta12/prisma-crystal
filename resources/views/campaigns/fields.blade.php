<!-- Campaign Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('campaign_name', 'Campaign Name:') !!}
    {!! Form::text('campaign_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Id Field -->
<div class="form-group col-sm-6">
    <label>Client Name</label>
    <select name="client_id" class="form-control select2">
    	@foreach($clients as $cc)
    		<option value="{{$cc->id}}" @if(isset($campaign) && ($campaign->client_id == $cc->id ))  selected @endif>{{$cc->client_name}}</option>
    	@endforeach
    </select>
</div>

<!-- Campaign Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('campaign_description', 'Campaign Description:') !!}
    {!! Form::textarea('campaign_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.campaigns.index') !!}" class="btn btn-default">Cancel</a>
</div>
