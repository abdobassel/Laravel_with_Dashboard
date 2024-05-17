@extends('layouts.app')
@section('title')
    Edit Product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form class="forms-sample" enctype="multipart/form-data"
                            action="{{ route('admin.product.update', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="productid" value="{{ $product->id }}">

                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1"
                                    placeholder="Name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Price</label>
                                <input type="text" class="form-control" name="price" id="exampleInputEmail3"
                                    placeholder="Price" value="{{ $product->price }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Description</label>
                                <input type="text" class="form-control" name="desc" id="exampleInputEmail3"
                                    placeholder="Description" value="{{ $product->description }}">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Product Picture</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                    name="product_img">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
