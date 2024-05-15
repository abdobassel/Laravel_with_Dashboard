@extends('layouts.app')
@section('title')
    Profile
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <form class="forms-sample" enctype="multipart/form-data" id="profile_setup_frm" action="">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" id="exampleInputName1"
                        placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" value="{{ auth()->user()->email }}" id="exampleInputEmail3"
                        placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                </div>


                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
