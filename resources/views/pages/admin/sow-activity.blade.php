@php
    if($assign) {
        $staff = \App\Models\User::where(['id' => $assign->user_id])->first();
    }
@endphp

@extends('layouts.main')
@section('content')
    <div class="container-fluid">

        @if(!$assign)
            <div class="project-nav">
                <div class="card-action card-tabs  mr-auto">
                    <ul class="nav nav-tabs style-2">
                        <li class="nav-item">
                            <span class="nav-link active">{{ $sow->sow_no }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->breed }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->date_born }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->origin }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->dam }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->date_procured }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $sow->sire }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form id="assignStaffForm">
                        @csrf
                        <div class="form-group">
                            <label>Please assign a staff first:</label>
                            <select name="user_id">
                                @foreach(\App\Models\User::where('role', 'Staff')->get() as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="sow_id" value="{{ $sow->id }}">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </form>
                </div>
            </div>
        @else
            <div class="profile card card-body px-3 pt-3 pb-0">
                <p>
                    <strong class="text-danger">Assigned to:</strong>
                </p>
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="{{ asset('storage/users-avatar/' . auth()->user()->avatar) }}" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $staff->name }}</h4>
                                <p>Staff</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <p>{{ $staff->email }} / {{ $staff->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Sow No.</label><br>
                                <h4 class="text-black">{{ $sow->sow_no }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Breed</label><br>
                                <h4 class="text-black">{{ $sow->breed }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Date Born</label><br>
                                <h4 class="text-black">{{ $sow->date_born }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Origin</label><br>
                                <h4 class="text-black">{{ $sow->origin }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>DAM</label><br>
                                <h4 class="text-black">{{ $sow->dam }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Date Procured</label><br>
                                <h4 class="text-black">{{ $sow->date_procured }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Sire</label><br>
                                <h4 class="text-black">{{ $sow->sire }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#breeding">Breeding</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#feeding">Feeding</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="breeding" role="tabpanel">
                                <button id="addNewSetBtn" type="button" class="btn btn-link mt-2 mb-2">
                                    <i class="fa fa-plus"></i> Add New Set
                                </button>
                                @if(! \App\Models\Litter::where('sow_id', $sow->id)->first())
                                    <p>no schedules yet</p>
                                @else
                                    <div id="accordion-one" class="accordion accordion-primary">
                                        @foreach(\App\Models\Litter::where('sow_id', $sow->id)->get() as $index => $litter)
                                            <div class="accordion__item">
                                                <div class="accordion__header {{ $index !== 0 ? 'collapsed' : '' }} rounded-lg" data-toggle="collapse" data-target="#{{ $litter->litter_no }}">
                                                    <span class="accordion__header--text font-weight-bold">#{{ $litter->litter_no }}</span>
                                                    <span class="accordion__header--indicator"></span>
                                                </div>
                                                <div id="{{ $litter->litter_no }}" class="collapse accordion__body {{ $index == 0 ? 'show' : '' }}" data-parent="#accordion-one">
                                                    <div class="accordion__body--text">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-header text-center">
                                                                        <strong>Mating</strong>
                                                                        <button type="button" id="addMatingBtn" data-litter_no="{{ $litter->litter_no }}" class="btn btn-link float-right">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                    <table class="table table-bordered" style="width: 100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="font-size: 10px">DATE</th>
                                                                            <th class="text-center" style="font-size: 10px">BOAR</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @if(! \App\Models\Mating::where('litter_no', $litter->litter_no)->first())
                                                                            <tr>
                                                                                <td colspan="2" class="text-center" style="font-size: 10px">not set</td>
                                                                            </tr>
                                                                        @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-header text-center">
                                                                        <strong>Farrowing</strong>
                                                                        <button type="button" class="btn btn-link float-right">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </div>
                                                                    <table class="table table-bordered" style="width: 100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="font-size: 10px">ACTUAL DATE</th>
                                                                            <th class="text-center" style="font-size: 10px">STATUS</th>
                                                                            <th class="text-center" style="font-size: 10px">AVE. WT.</th>
                                                                            <th class="text-center" style="font-size: 10px">FOSTER MI -/+</th>
                                                                            <th class="text-center" style="font-size: 10px">FROM/TO SOW</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @if(! \App\Models\Farrowing::where('litter_no', $litter->litter_no)->first())
                                                                            <tr>
                                                                                <td colspan="5" class="text-center" style="font-size: 10px">not set</td>
                                                                            </tr>
                                                                        @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-header text-center">
                                                                        <strong>Weaning</strong>
                                                                        <button type="button" class="btn btn-link float-right">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>
                                                                    </div>
                                                                    <table class="table table-bordered" style="width: 100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="text-center" style="font-size: 10px">DATE</th>
                                                                            <th class="text-center" style="font-size: 10px">NO.</th>
                                                                            <th class="text-center" style="font-size: 10px">AVE. WT.</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @if(! \App\Models\Weaning::where('litter_no', $litter->litter_no)->first())
                                                                            <tr>
                                                                                <td colspan="3" class="text-center" style="font-size: 10px">not set</td>
                                                                            </tr>
                                                                        @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                                <div class="form-group">
                                                                    <label>Remarks</label>
                                                                    <textarea name="remarks" class="form-control"></textarea>
                                                                    <button type="submit" class="btn btn-light mt-2">Save Remarks</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="feeding">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <! -- ----- Modals ----- -- !>
    <div id="addMatingModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <form id="addMatingForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Mating Schedule</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Boar</label>
                        <input type="text" name="boar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="litter_no">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('select[name="user_id"]').select2();
        });
    </script>
    <script>
        const sow_id = '{{ $sow->id }}';
    </script>
@endpush
