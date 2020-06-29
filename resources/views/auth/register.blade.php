@extends('layouts.auth')

@section('content')

    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0">Sign Up to user</h3>

            <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label>User Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" required
                               placeholder="Name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <label>Email Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" required
                               placeholder="Email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Password Confirm</label>
                        <input type="password" class="form-control"
                               name="password_confirmation" required placeholder="Password Confirm">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button
                            class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light"
                            type="submit">Log In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
