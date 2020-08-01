<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Create New ProductAttribute Value for #{{ $productattribute->id }}-{{$productattribute->name }}</div>
            <div class="card-body">

               {{--  {!! $errors->first('value', '<p class="help-block">:message</p>') !!} --}}

                {!! Form::open(['url' => '/admin/product-attribute-values', 'class' => 'form-horizontal', 'files' => true,'id'=>'attribute_values',"onsubmit"=>"return valid_value()"]) !!}

                @include ('admin.product-attribute-values.form', ['formMode' => 'create'])

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Values List</div>
            <div class="card-body">
                <div class="table-responsive">
                            <table class="table" id="attribute_list">
                                <thead>
                                    <tr>
                                        
                                        <th>Value</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productattribute->values as $value)
                                    <tr> 
                                       {{--  {{ dd()}} --}}
                                        <td>{{ $value->value }}</td>
                                        <td>
                                            <form action="{{ route('admin.product-attribute-values.destroy',$value->id)}}" method="post">
                                                 @method('DELETE')
                                            @csrf
                                            <button type="submit"  class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <h3>No Records</h3>
                                    @endforelse
{{-- {{ dd($productattribute->values->toArray()) }} --}}
                                    
                                                                   
                                </tbody>
                            </table>
                        {{--     <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div> --}}
                        </div>   

            </div>
        </div>
    </div>
</div>
@push('js')
<script type="text/javascript">
     
function valid_value(){
     $.ajax({
        type: "get",
        url: "ajax/valid_value",
        data: {
            value: $('#value').val()
        },
        async:false,
        success: function (data) {
        isSuccess = JSON.parse(data);
         }
      });
}
</script>
@endpush