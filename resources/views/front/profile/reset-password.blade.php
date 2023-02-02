@extends('front.layouts.Dispatch-layout')

@section('page-title',"Reset Password")

@section('css')
    <style>
        /*my css*/
    </style>
@stop

@section('content')
<main id="main" class="page-summary" data-page="summary">
<div class="pg-container container-fluid">

{{--@include('front.partials.success')--}}
<!-- Content Area - [Start] -->
<div id="main_content_area">
<div class="row no-gutters">
<!-- Sidebar -->
<aside id="left_sidebar" class="col-12 col-lg-3">
    <div class="inner">
        <div class="widget_sidebar d-none d-lg-block">
            <nav class="sidebar_nav">
                <ul class="no-list">
                    <li><a href="{{url('edit-profile')}}">Profile</a></li>
                    <li><a href="{{url('reset-password')}}">Password Reset</a></li>
                </ul>
            </nav>
        </div>
    </div>
</aside>

<aside id="right_content" class="col-12 col-lg-9">
    <div class="inner">
            <div class="content_header_wrap">
                <div class="hgroup divider-after left">
                    <h1 class="lh-10">Reset Password</h1>
                </div>
            </div>

            <div class="content_header_wrap">
                @include('front.partials.errors')
            </div>

            <form method="POST" action="{{ route('users.change-password') }}" id="account-form"  class="needs-validation" novalidate>
                @csrf
                <section class="form-section pb-0">
                    <div class="section-inner">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 no-min-h">
                                <label for="oldPassword">Old password</label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('oldPassword') }}" placeholder="John" id="oldPassword" name="oldPassword" required>
                                <div class="invalid-feedback">
                                    Please provide a old password.
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 no-min-h">
                                <label for="password">New password</label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('password') }}" placeholder="John" id="password" name="password" required>
                                <div class="invalid-feedback">
                                    Please provide a new password.
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 no-min-h">
                                <label for="password_confirmation">Confirm password</label>
                                <input type="text" class="form-control form-control-lg" value="{{ old('password_confirmation') }}" placeholder="John" id="password_confirmation"  name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    Please provide a valid confirm password.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="content_footer_wrap">
                    <button type="submit" class="btn btn-primary submitButton">Reset Password</button>
                </div>
            </form>
        </div>
</aside>
</div>
</div>
<!-- Content Area - [/end] -->
</div>
</main>
@stop

@section('js')
    <script>
        /*my js*/
    </script>
@stop