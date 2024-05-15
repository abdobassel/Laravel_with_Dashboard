@extends('layouts.app')
@section('title')
    Admin Profile
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
                    <h4 class="card-title">Edit Profile</h4>
                    @if (auth()->user()->profile_picture)
                        <div class="text-center">
                            <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile Image" class="img-fluid mb-3"
                                style="max-width: 200px;">
                        </div>
                    @endif


                    <form class="forms-sample" enctype="multipart/form-data" id="profile_setup_frm"
                        action="{{ route('profile.update', ['userid' => auth()->user()->id]) }}" method="POST">

                        @csrf
                        <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
                        <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}"
                                id="exampleInputName1" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email"
                                id="exampleInputEmail3" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword4">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword4"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Profile Picture</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="profile_img">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
