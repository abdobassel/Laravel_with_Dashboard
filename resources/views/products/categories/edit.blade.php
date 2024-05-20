@extends('layouts.app')
@section('title')
    Edit Category
@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4><br>
                        <form class="forms-sample" enctype="multipart/form-data" action="#" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="categoryid" value="{{ $category->id }}">

                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1"
                                    placeholder="Name" value="{{ $category->name }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail3">Description</label>
                                <input type="text" class="form-control" name="desc" id="exampleInputEmail3"
                                    placeholder="Description" value="{{ $category->description }}">
                            </div>



                            <div class="form-group">
                                <label for="exampleFormControlFile1">Category Picture</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="cat_img">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
