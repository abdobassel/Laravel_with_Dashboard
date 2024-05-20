@extends('layouts.app')
@section('title')
    Categories
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
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories</h1>
        <hr>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add Category</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>

                                <th>Description</th>
                                <th>Actions</th>


                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>

                                <th>Description</th>

                                <th>Actions</th> <!-- Add this footer -->
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>

                                    <td>{{ $category->description }}</td>


                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.category.edit', $category->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a href="#" class="btn btn-sm btn-primary">Show </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.category.destroy', ['id' => $category->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
