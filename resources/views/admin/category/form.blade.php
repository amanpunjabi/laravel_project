<div class="form-group {{ $errors->has('category_name') ? 'has-error' : ''}}">
    {!! Form::label('category_name', 'Category Name', ['class' => 'control-label']) !!}
    {!! Form::text('category_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    {!! Form::label('parent_id', 'Parent Id', ['class' => 'control-label']) !!}
    {{-- {!! Form::select('parent_id', json_decode('{"2":"superadmin","3":"admin","4":"customer"}', true), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!} --}}
 
    {{ Form::select('parent_id',$categories,null,['placeholder' => 'Select','class' => 'form-control']) }}
                        
                  
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
