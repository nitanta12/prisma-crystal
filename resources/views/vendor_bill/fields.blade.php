

<div class="form-group col-sm-12">
    {!! Form::label('job_estimate_number', 'Job Estimate Number:') !!}
    {!! Form::text('job_estimate_number', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::label('bill_number', 'Bill Number:') !!}
    {!! Form::text('bill_number',null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('vendor', 'Vendor:') !!}
    <select class="form-control select2" name="vendor">
    	@foreach($vendors as $vendor)
    		<option value="{{$vendor->id}}" @if(isset($vendor_bill)) @if($vendor_bill->vendor==$vendor->id) selected @endif @endif>{{$vendor->vendor_name}}</option>

    	@endforeach
    </select>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('bill_amount', 'Bill Amount:') !!}
    {!! Form::text('bill_amount',null,['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <select class="form-control select2" name="status">
        <option value="pending" @if(isset($vendor_bill)) @if($vendor_bill->status=='pending') selected @endif @endif>Pending</option>
    	<option value="processing" @if(isset($vendor_bill)) @if($vendor_bill->status=='processing') selected @endif @endif>Processing</option>
    	<option value="completed" @if(isset($vendor_bill)) @if($vendor_bill->status=='completed') selected @endif @endif>Completed</option>
    	<option value="cancelled" @if(isset($vendor_bill)) @if($vendor_bill->status=='cancelled') selected @endif @endif>Cancelled</option>
    </select>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('remarks', 'Remarks:') !!}
    {!! Form::text('remarks',null,['class' => 'form-control']) !!}
</div>
    <div class="form-group col-sm-12">
        @if(isset($vendor_bill))
            @if($vendor_bill->file)
                <a href="{{asset('bills')}}/{{$vendor_bill->file}}" target="_blank">{{$vendor_bill->file}}</a>
            @endif
            <br/>
        @endif
        {!! Form::label('file', 'Upload File:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
    </div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>
