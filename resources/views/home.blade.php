@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Product List</h3>
                        <span>
                            <a href="{{ route('index.create') }}" class="btn btn-success">Create Product</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($products) > 0)
                            <table class="table table-striped table-bordered mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <th scope="row">{{$key + $products->firstItem()}}</th>
                                            <td>{{$product->title}}</td>
                                            <td>{{Str::limit($product->description, 50)}}</td>
                                            <td>{{$product->price}}</td>
                                            <td><img src="{{$product->thumbnail}}" alt="" width="50"></td>
                                            <td>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2>No Products Available!!</h2>
                        @endif
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
