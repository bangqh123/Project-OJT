<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Woah!</strong> There were some errors with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="Name" value="{{ $product->Name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control"  name="Desc" placeholder="Desc" value="{{ $product->Desc }}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Quantity:</strong>
                            <input class="form-control"  name="Quantity" placeholder="Quantity" value="{{ $product->Quantity }}">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Unit:</strong>
                            <input class="form-control"  name="Unit" placeholder="Unit" value="{{ $product->Unit }}">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Price:</strong>
                            <input class="form-control" name="Price" placeholder="Price" value="{{ $product->Price }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Image:</strong>
                            <input type="file" name="image" class="form-control" placeholder="image">
                            <img src="/asset/image/products/{{ $product->image }}" width="150">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Product Category:</strong>
                            <select name="Category_id" class="form-control">
                                <option value="" disabled selected>Select a Category</option>
                                @foreach($category as $category)
                                    <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>Supplier Name:</strong>
                            <select name="Supplier_id" class="form-control">
                                <option value="" disabled selected>Select a Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $product->supplier->id == $supplier->id ? 'selected' : '' }}>{{ $supplier->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="pull-left">
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <br>
    </body>
</html>
