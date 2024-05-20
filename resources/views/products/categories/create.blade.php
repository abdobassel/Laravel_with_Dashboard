@extends('layouts.app')
@section('title')
    Add Category
@endsection

@section('content')
    @if (session('success'))
        <div class="text-center alert alert-success">
            <h1>{{ session('success') }}</h1>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Category</h4>

                    <form class="forms-sample" enctype="multipart/form-data" action="{{ route('admin.category.store') }}"
                        method="POST">
                        @csrf


                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputName1"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Description</label>
                            <input type='text' name="desc" class="form-control" id="exampleInputName1"
                                placeholder="Description">
                        </div>



                        <div class="form-group">
                            <label for="exampleFormControlFile1">Category Picture</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1"
                                name="category_img">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
