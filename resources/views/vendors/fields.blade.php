<!-- Vendor Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vendor_name', 'Vendor Name:') !!}
    {!! Form::text('vendor_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
     {!! Form::label('vendor_type', 'Vendor Type:') !!}
     @php
     if(isset($vendors))
     {
        $type = $vendors->vendor_type;
        $is_media = $vendors->is_media;
     }
     else
     {
        $type = '';
        $is_media = '';
     }
    @endphp

     <select class="form-control" name="vendor_type">
            <option value="" @if($type == '') selected @endif>Select</option>
            <option value="national_daily" @if($type == 'national_daily') selected @endif>National Daily</option>
            <option value="tv" @if($type == 'tv') selected @endif>TV</option>
            <option value="magazine" @if($type == 'magazine') selected @endif>Magazine</option>
            <option value="local_newspaper" @if($type == 'local_newspaper') selected @endif>Local Newspaper</option>
            <option value="radio" @if($type == 'radio') selected @endif>Radio</option>
            
            <option value="online_portal" @if($type == 'online_portal') selected @endif>Online Portal</option>

             <option value="movie" @if($type == 'online_portal') selected @endif>Movie Theatre</option>

            <option value="others" @if($type == 'others') selected @endif>Others</option>
     </select>
</div>  

<div class="form-group col-sm-12">
    {!! Form::label('is_media','Is Media:') !!}
    <select class="form-control" name="is_media">
        <option value="yes" @if($is_media == 'yes') selected @endif>Yes</option>
        <option value="no" @if($is_media == 'no') selected @endif>No</option>
    </select>

</div>

<!-- Vendor Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vendor_phone', 'Vendor Phone:') !!}
    {!! Form::text('vendor_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Vendor Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('vendor_address', 'Vendor Address:') !!}
    {!! Form::text('vendor_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Vendor Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('vendor_description', 'Vendor Description:') !!}
    {!! Form::textarea('vendor_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.vendors.index') !!}" class="btn btn-default">Cancel</a>
</div>
