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

            <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="Name" value="{{ $category->Name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-10 col-sm-10 col-md-10">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control"  name="Desc" placeholder="Desc" value="{{ $category->Desc }}"></textarea>
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
