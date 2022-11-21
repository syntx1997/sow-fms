@extends('layouts.main')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <strong>{{ $title }}</strong>
            </div>
            <div class="card-body">
                <table class="style-1 viewPhotoLightGallery" id="pigTable" style="width: 100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Type</th>
                        <th>PIG No.</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

@endsection

<!-- ----- JavaScript ----- -->
@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script>const staffId = {{ auth()->user()->id }};</script>
@endpush

<!-- ----- CSS ----- -->
@push('css')
    <link href="{{ asset('vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
@endpush

