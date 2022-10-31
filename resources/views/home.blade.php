@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Product List</h3>
                        <span>
                            <a href="{{ route('create') }}" class="btn btn-success">Create Product</a>
                        </span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('filter') }}" method="GET">
                            @csrf
                            <div class="row">
                                @if (session('productDelete'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-bs-dismiss="alert">&times;</button>
                                        {{ session('productDelete') }}
                                    </div>
                                    <div class="alert-box--success" id="successBox">
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div id="searchbox">
                                        <input type="text" class="form-control" id="title"
                                            placeholder="search here ..." name="search">
                                    </div>
                                    <div class="row" id="pricebox" style="display: none">
                                        <div class="col-6">
                                            <input type="number" name="min" min="0" class="form-control"
                                                placeholder="minimum price">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" name="max" min="0" class="form-control"
                                                placeholder="maximum price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select id="filterbox" class="form-control" name="filterby">
                                        <option selected disabled>Choose Your Filter ...</option>
                                        <option value="title">Title</option>
                                        <option value="category">Category</option>
                                        <option value="subcategory">Subcategory</option>
                                        <option value="price">Price Range</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        @if (count($products) > 0)
                            <table class="table table-striped table-bordered mt-3">
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
                                            <th scope="row">
                                                @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                    {{ $key + $products->firstItem() }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </th>
                                            <td>{{ $product->title }}</td>
                                            <td>{!! Str::limit($product->description, 50) !!}</td>
                                            <td>{{ $product->price }}</td>
                                            <td><img src="{{ asset('uploads/' . $product->thumbnail) }}" alt=""
                                                    width="50"></td>
                                            <td>
                                                <a href="{{ route('delete', ['id' => $product->id]) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h2>No Products Available!!</h2>
                        @endif
                        @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $products->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const filterbox = document.getElementById('filterbox');
        filterbox.addEventListener('change', changeDisplay);

        function changeDisplay() {
            $searchbox = document.getElementById('searchbox');
            $pricebox = document.getElementById('pricebox');
            if (filterbox.value == 'price') {
                $pricebox.style.display = 'block';
                $searchbox.style.display = 'none';
                // console.log('asche');
            } else {
                $pricebox.style.display = 'none';
                $searchbox.style.display = 'block';
            }
        }
    </script>
@endsection
