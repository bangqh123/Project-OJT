@extends('layouts.layout')

@section('content')
<div class="col-lg-12 margin-tb">
    <div class="pull-left">
        <h1>Home</h1>
    </div>
</div>
<div class="col-lg-12 margin-tb">
    <a class="btn btn-info" href="{{ route('products.index') }}">Product</a>
    <a class="btn btn-info" href="{{ route('category.index') }}">Category</a>
    <a class="btn btn-info" href="{{ route('supplier.index') }}">Suppliers</a>
</div>
{{-- @foreach($products as $item)
    <tr>
        <div class="card">
            <img src="/asset/image/products/{{ $item->image }}" width="100">
            <h1>{{ $item->Name }}</h1>
            <p class="price">{{ $item->Price }} VND</p>
            <p>{{ $item->Desc }}</p>
            <p><button>Add to Cart</button></p>
        </div>
    </tr>
@endforeach --}}
@endsection
