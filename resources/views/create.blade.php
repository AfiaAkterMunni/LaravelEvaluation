@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Create a product</h3>
                    <span>
                        <a href="{{route('home')}}" class="btn btn-primary">Back</a>
                    </span>
                </div>

                <div class="card-body">
                    <form>
                        <div class="form-group mb-3">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Choose Category</label>
                            <select id="category" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="subcategory">Choose Subcategory</label>
                            <select id="subcategory" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price">
                        </div>
                        <div class="form-group mb-3">
                            <label for="thumbnail">Thumbnail</label><br>
                            <input type="file" class="form-control-file" placeholder="Choose Thumbnail" id="thumbnail">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
