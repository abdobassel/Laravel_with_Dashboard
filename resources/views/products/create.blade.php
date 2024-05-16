@extends('layouts.app')
@section('title')
    Add Product
@endsection

@section('content')
    @if (session('success'))
        <div class="text-center alert alert-success">
            <h1>{{ session('success') }}</h1>
        </div>
    @endif
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product</h4>

                    <form class="forms-sample" enctype="multipart/form-data" id="profile_setup_frm"
                        action="{{ route('admin.product.store') }}" method="POST">
                        @csrf


                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Price</label>
                            <input type="text" class="form-control" name="price" id="exampleInputEmail3"
                                placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Description</label>
                            <input type="text" class="form-control" name="desc" id="exampleInputEmail3"
                                placeholder="Description">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Product Picture</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="product_img">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
