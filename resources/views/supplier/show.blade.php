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

            <div class="row">
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <div class="form-group">
                        <img src="/asset/image/suppliers/{{ $supplier->image }}" width="200">
                    </div>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $supplier->Name }}
                    </div>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <div class="form-group">
                        <strong>Address:</strong>
                        {{ $supplier->Address }}
                    </div>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <div class="form-group">
                        <strong>Numbers:</strong>
                        {{ $supplier->Numbers }}
                    </div>
                </div>

            </div>
        </div>
        <br>
    </body>
</html>

