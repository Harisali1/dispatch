@extends('front.layouts.login')

@section('content')

<!-- BEGIN LOGIN FORM -->
<div class="row no-gutters justify-content-center">
    <div class="col-10 col-md-9 col-lg-5 col-xl-5">
        <div class="hgroup divider-after align-center">
            <h1>Login to Dispatch Portal</h1>
            <p class="f14">To login please enter your login credentials provided by admin</p>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger custom">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br />
                @endforeach
            </div>
        @endif

        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                {{ session('message') }}
            </div>
    @endif

        <!-- Login Form -->
        <form method="POST" action="{{ url('login-joey') }}" id="login-form"  class="needs-validation" novalidate>
            @csrf

            <div class="form-group align-center">
                <label for="emailInput">Email / username</label>
                <input type="email" name="email" class="form-control form-control-lg" id="emailInput" required>
                <div class="invalid-feedback">
                    Please provide email
                </div>
            </div>

            <div class="form-group align-center">
                <label for="paswordInput">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" id="paswordInput" required>
                <div class="invalid-feedback">
                    Please provide password
                </div>
            </div>
            <div class="align-center">
                <button type="submit" class="btn btn-primary submitButton">Login</button>
            </div>
        </form>
        <div class="extra-info">
            <p class="forgot-pwd align-center"><a href="{{url('password/reset')}}">Lost your password?</a></p>
        </div>
    </div>
</div>
<!-- END LOGIN FORM -->

@stop
