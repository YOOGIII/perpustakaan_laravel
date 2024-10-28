@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary text-white" style="height: 40vh;">
    <div class="container text-center">
        <br>
        <h1 class="display-5">Welcome to Website Product Page</h1>
        <p class="lead">Explore our list of products available.</p>
        <a href="{{ route('products.index') }}" class="btn btn-light btn-lg mt-3">
            <i class="fas fa-box"></i> Data Product
        </a>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Product 1</h5>
                    <p class="card-text">Description of Product 1.</p>
                    <a href="#" class="btn btn-outline-primary">View Product</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Product 2</h5>
                    <p class="card-text">Description of Product 2.</p>
                    <a href="#" class="btn btn-outline-primary">View Product</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Product 3</h5>
                    <p class="card-text">Description of Product 3.</p>
                    <a href="#" class="btn btn-outline-primary">View Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
