@extends('layouts.main')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-sm-flex d-block">
                <div class="mr-auto mb-sm-0 mb-3">
{{--                    <h4 class="card-title mb-2">Pig Management</h4>--}}
                    <span>Boar List</span>
                </div>
                <button class="btn btn-info" data-toggle="modal" data-target="#addPigModal"><i class="fa fa-plus"></i> Add Boar</button>
            </div>
            <div class="card-body">
                <div class="table-responsive1">
                    <table class="table style-1 viewPhotoLightGallery responsive" id="pigTable" style="width: 100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>BOAR No.</th>
                            <th>BREED</th>
                            <th>DATE BORN</th>
                            <th>ORIGIN</th>
                            <th>DAM</th>
                            <th>DATE PROCURED</th>
                            <th>SIRE</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="addPigModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addPigForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i> Add Boar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Breed</label>
                        <div class="col-9">
                            <select name="breed" class="form-control">
                                <option value="Duroc">Duroc</option>
                                <option value="Landrace">Landrace</option>
                                <option value="Large White">Large White</option>
                                <option value="Native">Native</option>
                                <option value="Petrain">Petrain</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Date Born</label>
                        <div class="col-9">
                            <input type="date" name="dateBorn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Origin</label>
                        <div class="col-9">
                            <input type="text" name="origin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">DAM</label>
                        <div class="col-9">
                            <select name="dam" class="form-control">
                                @foreach(\App\Models\Pig::where('type', 'Sow')->get() as $pig)
                                    <option value="{{ $pig->pig_no }}">{{ $pig->pig_no }}</option>
                                @endforeach
                                <option value="none">none</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Date Procured</label>
                        <div class="col-9">
                            <input type="date" name="dateProcured" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Sire</label>
                        <div class="col-9">
                            <select name="sire" class="form-control">
                                @foreach(\App\Models\Pig::where('type', 'Boar')->get() as $pig)
                                    <option value="{{ $pig->pig_no }}">{{ $pig->pig_no }}</option>
                                @endforeach
                                <option value="none">none</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Duration</label>
                        <div class="col-9">
                            <input type="number" name="duration" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3">Photo</label>
                        <div class="col-9">
                            <div id="photo">
                                <img src="{{ asset('storage/pigs-photo/no-img.png') }}" style="width: 100%">
                            </div>
                            <button type="button" id="uploadPhotoBtn" class="btn btn-light mt-2">
                                <i class="fa fa-upload"></i> Upload Photo
                            </button>
                            <input type="file" name="photo" style="display: none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" value="Boar">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editPigModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editPigForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-edit"></i> Edit Boar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Boar No.</label>
                        <div class="col-9">
                            <input type="text" name="pigNo" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Breed</label>
                        <div class="col-9">
                            <select name="breed" class="form-control">
                                <option value="Duroc">Duroc</option>
                                <option value="Landrace">Landrace</option>
                                <option value="Large White">Large White</option>
                                <option value="Native">Native</option>
                                <option value="Petrain">Petrain</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Date Born</label>
                        <div class="col-9">
                            <input type="date" name="dateBorn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Origin</label>
                        <div class="col-9">
                            <input type="text" name="origin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">DAM</label>
                        <div class="col-9">
                            <select name="dam" class="form-control">
                                @foreach(\App\Models\Pig::where('type', 'Sow')->get() as $pig)
                                    <option value="{{ $pig->pig_no }}">{{ $pig->pig_no }}</option>
                                @endforeach
                                <option value="none">none</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Date Procured</label>
                        <div class="col-9">
                            <input type="date" name="dateProcured" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Sire</label>
                        <div class="col-9">
                            <select name="sire" class="form-control">
                                @foreach(\App\Models\Pig::where('type', 'Boar')->get() as $pig)
                                    <option value="{{ $pig->pig_no }}">{{ $pig->pig_no }}</option>
                                @endforeach
                                <option value="none">none</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-3">Photo</label>
                        <div class="col-9">
                            <div id="photo">
                                <img src="{{ asset('storage/pigs-photo/no-img.png') }}" style="width: 100%">
                            </div>
                            <button type="button" id="uploadPhotoBtn" class="btn btn-light mt-2">
                                <i class="fa fa-upload"></i> Upload Photo
                            </button>
                            <input type="file" name="photo" style="display: none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

<!-- ----- JavaScript ----- -->
@push('js')
    <script>const type = 'Boar';</script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
@endpush

<!-- ----- CSS ----- -->
@push('css')
    <link href="{{ asset('vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush
