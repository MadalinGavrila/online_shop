@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Products <small>SubCategories</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Product:</strong> {{$product->name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminProductController@addSubCategory', $product->id]]) !!}

                <div class="form-group">
                    {!! Form::label('category', 'Category:') !!}
                    {!! Form::select('category', [''=>'Select Category'] + $categories, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('subCategory', 'SubCategory:') !!}
                    {!! Form::select('subCategory', [], null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add SubCategory', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <div class="col-sm-6">
        @if(count($product_subCategories))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_subCategories as $subCategory)
                        <tr>
                            <td>{{$subCategory->category->name}}</td>
                            <td>{{$subCategory->name}}</td>
                            <td>
                                {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminProductController@withdrawSubCategory', $product->id]]) !!}

                                    <input type="hidden" name="subCategory" value="{{$subCategory->id}}" />

                                    <div class="form-group">
                                        {!! Form::submit('Remove', ['class'=>'btn btn-danger btn-xs']) !!}
                                    </div>

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$product_subCategories->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No SubCategories</p>
            </div>
        @endif
    </div>

@endsection

@section('scripts')

    <script>

        $('#category').on('change', function(){
            if($(this).val() != ''){
                var cat_id = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{route('admin.products.ajaxSubCategory')}}",
                    method: "POST",
                    data: {cat_id:cat_id, _token:_token},
                    success:function(result)
                    {
                        $('#subCategory').html(result);
                    }
                });
            }
        });

    </script>

@endsection