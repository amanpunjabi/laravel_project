 
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
    {!! Form::text('slug', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required','readonly'=>'readonly'] : ['class' => 'form-control','readonly'=>'readonly'],) !!}
  
</div>
 
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
    {!! Form::text('subject', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
     
</div>
 
 
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
    {!! Form::textarea('message', null,  ['class' => 'form-control summernote'] ) !!}
     
</div>
 
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endpush