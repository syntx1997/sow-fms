@extends('layouts.main')
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-sm-flex d-block">
                <div class="mr-auto mb-sm-0 mb-3">
                    <h4 class="card-title mb-2">Sow Management</h4>
                    <span>Sow List</span>
                </div>
                <button class="btn btn-info" data-toggle="modal" data-target="#addSowModal"><i class="fa fa-plus"></i> Add Sow</button>
            </div>
            <div class="card-body">
                <div class="table-responsive1">
                    <table class="table style-1" id="sowTable">
                        <thead>
                        <tr>
                            <th>SOW No.</th>
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

    <div id="addSowModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addSowForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-plus"></i> Add Sow
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Breed</label>
                        <div class="col-9">
                            <input type="text" name="breed" class="form-control">
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
                            <input type="text" name="dam" class="form-control">
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
                            <input type="text" name="sire" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editSowModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editSowForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-edit"></i> Edit Sow
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-3">Sow No.</label>
                        <div class="col-9">
                            <input type="text" name="sowNo" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Breed</label>
                        <div class="col-9">
                            <input type="text" name="breed" class="form-control">
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
                            <input type="text" name="dam" class="form-control">
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
                            <input type="text" name="sire" class="form-control">
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
@push('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
@endpush
