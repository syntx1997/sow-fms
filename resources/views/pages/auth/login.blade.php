@extends('layouts.auth')
@section('content')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('images/st-logo-text.png') }}" alt="logo" style="width: 150px">
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form id="login-form">
                                        @csrf
                                        <div id="#notification"></div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <div class="input-group mb-2 mr-sm-2">
                                                <input type="password" id="password" name="password" class="form-control">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" onclick="password_show_hide();">
                                                        <i class="flaticon-057-eye" id="show_eye"></i>
                                                        <i class="flaticon-058-hide d-none" id="hide_eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
