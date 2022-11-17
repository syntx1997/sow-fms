@extends('layouts.main')
@section('content')

<div class="container-fluid1">

    <div class="card vh-100">
        <div class="card-body chat-wrapper p-0">
            <div class="chat-hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="chat-left-sidebar">
                <div class="d-flex chat-fix-search align-items-center">
                    <button type="button" class="d-flex btn btn-link" data-toggle="modal" data-target="#addSupplierModal"><i class="flaticon-381-plus mr-3"></i> Add Supplier</button>
                </div>
                <div class="card-body message-bx px-0 pt-3">
                    <div class="tab-content dz-scroll" id="message-bx">
                        <div class="list-group list-group-flush">
                            @foreach(\App\Models\Supplier::all() as $supplier)
                                <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <strong class="mb-1">{{ $supplier->name }}</strong>
                                        <small class="text-muted"><i class="flaticon-381-map-2"></i></small>
                                    </div>
                                    <div class="col-10 mb-1 small">{{ $supplier->address }} - {{ $supplier->contact }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-right-sidebar">
                <div class="message-bx chat-box">
                    <div class="d-flex justify-content-between chat-box-header">
                        <div class="d-flex align-items-center">
                            <h5 class="text-black font-w500 mb-sm-1 mb-0 title-nm">Map Location</h5>
                        </div>
                    </div>
                    <div id="map" style="z-index: 0"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="addSupplierModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="addSupplierForm" class="modal-content" tabindex="-1">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Supplier</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Supplier Business Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" name="latitude" class="form-control">
                </div>
                <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" name="longitude" class="form-control">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" name="contact" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('css')
    <style>
        #map { min-height: 700px; }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
          integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
            integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg="
            crossorigin=""></script>
@endpush

@push('js')
    <script>
        const map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([51.5, -0.09]).addTo(map);
        var circle = L.circle([51.508, -0.11], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);
        var polygon = L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(map);
    </script>
    <script src="{{ asset('js/pages/dashboard/admin/suppliers.js') }}"></script>
@endpush
