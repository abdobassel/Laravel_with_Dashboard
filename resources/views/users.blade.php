@extends('layouts.app')
@section('title')
    Users
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
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        <hr>
        <a href="{{ route('admin.admins') }}" class="btn btn-primary">To Admins </a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>created at</th>

                                <th>Image</th>
                                <th>Actions</th> <!-- Add this header -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>email</th>
                                <th>created at</th>

                                <th>Image</th>
                                <th>Actions</th> <!-- Add this header -->
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>

                                    <td>
                                        <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->name }}"
                                            width="40" height="40">
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" class="btn btn-sm btn-primary">Approve</a>
                                        <!-- Delete Button
                                                                              
                                                                                        -->
                                        <form action="#" method="POST" style="display: inline;">
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
