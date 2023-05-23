<!-- Campaign Id Field -->
<div class="form-group">
    {!! Form::label('job_estimate_number', 'Job Estimate Number:') !!}
    <p>{!! $vendor_bill->job_estimate_number !!}</p>
</div>

<!-- Creative Brief Name Field -->
<div class="form-group">
    {!! Form::label('bill_number', 'Bill Number:') !!}
    <p>{!! $vendor_bill->bill_number !!}</p>
</div>

<!-- Creative Brief File Field -->
<div class="form-group">
    {!! Form::label('vendor', 'Vendor:') !!}
    <p>{!! $vendor_bill->vendor !!}</p>
</div>
<div class="form-group">
    {!! Form::label('bill_amount', 'Bill Amount:') !!}
    <p>{!! $vendor_bill->bill_amount !!}</p>
</div>
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $vendor_bill->status !!}</p>
</div>
<div class="form-group">
    {!! Form::label('user_id', 'User:') !!}
    <p>{!! $vendor_bill->user_id !!}</p>
</div>
<div class="form-group">
    {!! Form::label('remarks', 'Remarks:') !!}
    <p>{!! $vendor_bill->remarks !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $vendor_bill->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $vendor_bill->updated_at !!}</p>
</div>

