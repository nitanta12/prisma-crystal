<!-- Client Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_name', 'Client Name:') !!}
    {!! Form::text('client_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('user_id' , 'Assign CS') !!}

    <select  class="form-control select2" name="user_id[]" multiple="multiple" required>
        @foreach($users as $u)
            
            @php

                $selected = '';
                if(isset($editusers))
                {
                    if(in_array($u->id,$editusers))
                    {
                        $selected = 'selected';
                    }
                }

                
            @endphp

            <option value="{{$u->id}}" {{$selected}}>{{$u->name}}</option>

        @endforeach
    </select>
    

</div>

<!-- Client Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_phone', 'Client Phone:') !!}
    {!! Form::text('client_phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_address', 'Client Address:') !!}
    {!! Form::text('client_address', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Company Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_brand', 'Client Brand:') !!}
    {!! Form::text('client_brand', null, ['class' => 'form-control']) !!}
</div>
    
<!-- Client Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('representative', 'Client Representative:') !!}
    {!! Form::textarea('representative', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('client_description', 'Client Description:') !!}
    {!! Form::textarea('client_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('client_email', 'Client Email:') !!}
    {!! Form::text('client_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.clients.index') !!}" class="btn btn-default">Cancel</a>
</div>
