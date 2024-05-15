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
            <form class="forms-sample" enctype="multipart/form-data" id="profile_setup_frm"
                action="{{ route('profile.update', ['userid' => auth()->user()->id]) }} " method="POST">

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


                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
