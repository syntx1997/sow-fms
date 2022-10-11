@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-sm-flex d-block">
                <div class="mr-auto mb-sm-0 mb-3">
                    <h4 class="card-title mb-2">User Management</h4>
                    <span>Staff List</span>
                </div>
                <a href="javascript:void(0);" class="btn btn-info">+ Add Staff</a>
            </div>
            <div class="card-body">
                <div class="table-responsive1">
                    <table class="table style-1" id="staffTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>STAFF</th>
                            <th>DATE ADDED</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
@endpush
