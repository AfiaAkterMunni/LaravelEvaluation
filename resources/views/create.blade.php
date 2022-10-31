@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Create a product</h3>
                        <span>
                            <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
                        </span>
                    </div>

                    <div class="card-body">
                        @if (session('createProduct'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                                {{ session('createProduct') }}
                            </div>
                            <div class="alert-box--success" id="successBox">
                            </div>
                        @endif
                        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data" id="createForm">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="subcategory">Choose Subcategory</label>
                                <select id="subcategory" class="form-control" name="subcategory">
                                    <option selected disabled>Choose...</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="thumbnail">Thumbnail</label><br>
                                <input type="file" class="form-control-file" placeholder="Choose Thumbnail"
                                    id="thumbnail" name="thumbnail">
                                @error('thumbnail')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
