<div class="form-group {{ $errors->has('attribute_id') ? 'has-error' : ''}}">
     
    {!! Form::hidden('attribute_id', $productattribute->id, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('attribute_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    {!! Form::label('value', 'Value', ['class' => 'control-label']) !!}
    {!! Form::text('value', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
