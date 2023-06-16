<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel App Page</title>

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
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <img class="navbar-brand" src="/asset/icons/akaneshrug.png">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Product</a></li>
                    <li><a href="{{ route('category.index') }}">Category</a></li>
                    <li><a href="{{ route('supplier.index') }}">Supplier</a></li>
                </ul>


                <form class="form-inline navbar-right" type="get" action="{{ url('/search-product') }}">
                    <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search Product" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="container-fluid" style="margin-top:50px">

            @yield('content')

        </div>
    </body>
</html>
