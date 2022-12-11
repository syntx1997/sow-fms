@extends('layouts.main')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <strong>Update Information</strong>
            </div>
            <form id="updateInfoForm">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <div id="avatar">
                            <img src="{{ url('/storage/users-avatar/' . auth()->user()->avatar) }}" style="width: 200px">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar" style="display: none">
                        <button id="choosePhotoBtn" type="button" class="btn btn-link"><i class="fa fa-file-photo-o"></i> Choose Photo</button>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="form-group">
                        <label>Phone #</label>
                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="avatar_name" value="{{ auth()->user()->avatar }}">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <strong>Update Password</strong>
            </div>
            <form id="updatePasswordForm">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Re-Type Password</label>
                        <input type="password" name="retype_password" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>

@endsection
