<!-- Campaign Name Field -->
<div class="form-group">
    {!! Form::label('campaign_name', 'Campaign Name:') !!}
    <p>{!! $campaign->campaign_name !!}</p>
</div>

<!-- Client Id Field -->
<div class="form-group">
    {!! Form::label('client_id', 'Client Id:') !!}
    <p>{!! $campaign->client_id !!}</p>
</div>

<!-- Campaign Description Field -->
<div class="form-group">
    {!! Form::label('campaign_description', 'Campaign Description:') !!}
    <p>{!! $campaign->campaign_description !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $campaign->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $campaign->updated_at !!}</p>
</div>

