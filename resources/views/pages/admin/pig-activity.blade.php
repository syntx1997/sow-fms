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
                            <span class="nav-link active">{{ $pig->pig_no }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->breed }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->date_born }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->origin }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->dam }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->date_procured }}</span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ $pig->sire }}</span>
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
                        <input type="hidden" name="pig_id" value="{{ $pig->id }}">
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
                                <label>Pig No.</label><br>
                                <h4 class="text-black">{{ $pig->pig_no }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Breed</label><br>
                                <h4 class="text-black">{{ $pig->breed }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Date Born</label><br>
                                <h4 class="text-black">{{ $pig->date_born }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Origin</label><br>
                                <h4 class="text-black">{{ $pig->origin }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>DAM</label><br>
                                <h4 class="text-black">{{ $pig->dam }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Date Procured</label><br>
                                <h4 class="text-black">{{ $pig->date_procured }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Sire</label><br>
                                <h4 class="text-black">{{ $pig->sire }}</h4>
                            </div>
                            <div class="form-group">
                                <label>Type</label><br>
                                <h4 class="text-black">{{ $pig->type }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs mb-5">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#breeding">Breeding</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#feeding">Feeding</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="breeding" role="tabpanel">
                                @if(! \App\Models\Litter::where('pig_id', $pig->id)->first())
                                    <p>no schedules yet</p>
                                @else
                                    <div id="accordion-one" class="accordion accordion-primary">
                                        @foreach(\App\Models\Litter::where('pig_id', $pig->id)->get() as $index => $litter)
                                            <div class="accordion__item">
                                                <div class="accordion__header {{ $index !== 0 ? 'collapsed' : '' }} rounded-lg" data-toggle="collapse" data-target="#{{ $litter->litter_no }}">
                                                    <span class="accordion__header--text font-weight-bold">#{{ $litter->litter_no }}</span>
                                                    <span class="accordion__header--indicator"></span>
                                                </div>
                                                <div id="{{ $litter->litter_no }}" class="collapse accordion__body {{ $index == 0 ? 'show' : '' }}" data-parent="#accordion-one">
                                                    <div class="accordion__body--text">
                                                        <div class="row mb-3">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <span class="badge badge-rounded badge-danger">Days after Mated: <span class="font-weight-bold">0</span></span>
                                                                <span class="badge badge-rounded badge-danger">Days after Farrowed: <span class="font-weight-bold">0</span></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div id="DZ_W_TimeLine111" class="widget-timeline style-1">
                                                                    <ul class="timeline">
                                                                        <li>
                                                                            <div class="timeline-badge primary"></div>
                                                                            <div class="timeline-panel text-muted">
                                                                                <h6 class="mb-0">Mating</h6>
                                                                                @if(! \App\Models\Mating::where('litter_no', $litter->litter_no)->first())
                                                                                    <p class="text-muted">no schedule yet</p>
                                                                                @else
                                                                                    @foreach(\App\Models\Mating::where('litter_no', $litter->litter_no)->get() as $mating)
                                                                                        <table>
                                                                                            <tr>
                                                                                                <td class="text-center p-2">•</td>
                                                                                                <td class="text-center p-2">{{ $mating->date }}</td>
                                                                                                <td class="text-center p-2 align-middle font-weight-bold">{{ $mating->boar }}</td>
                                                                                                <td class="text-center p-2 align-middle">
                                                                                                    <a href="#" id="editMatingBtn" class="text-muted" data-data="{{ json_encode($mating) }}">
                                                                                                        <i class="fa fa-edit"></i>
                                                                                                    </a>
                                                                                                    <a href="#" id="deleteMatingBtn" class="text-muted" data-data="{{ json_encode($mating) }}">
                                                                                                        <i class="fa fa-trash"></i>
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    @endforeach
                                                                                @endif
                                                                                <button type="button" id="addMatingBtn" data-litter_no="{{ $litter->litter_no }}" class="btn btn-link btn-sm">
                                                                                    <i class="fa fa-plus"></i> Add New Schedule
                                                                                </button>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="timeline-badge info">
                                                                            </div>
                                                                            <div class="timeline-panel text-muted">
                                                                                <h6 class="mb-0">Farrowing</strong></h6>
                                                                                @foreach(\App\Models\Farrowing::where('litter_no', $litter->litter_no)->get() as $farrowing)
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">ACTUAL DATE</td>
                                                                                            <td class="p-2">{{ $farrowing->actual_date }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">STATUS</td>
                                                                                            <td class="p-2">{{ $farrowing->status }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">AVE. WEIGHT</td>
                                                                                            <td class="p-2">{{ $farrowing->weight }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">FOSTER MI -/+</td>
                                                                                            <td class="p-2">{{ $farrowing->dead }} / {{ $farrowing->alive }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">FROM/TO SOW</td>
                                                                                            <td class="p-2">{{ $farrowing->sow }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                @endforeach
                                                                                @if(! \App\Models\Farrowing::where('litter_no', $litter->litter_no)->first())
                                                                                    <p class="text-muted">no schedule yet</p>
                                                                                @endif
                                                                                <button type="button" id="editFarrowingBtn" class="btn btn-link" data-litter_no="{{ $litter->litter_no }}" data-farrowing="{{ json_encode(\App\Models\Farrowing::where('litter_no', $litter->litter_no)->first()) }}">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="timeline-badge danger">
                                                                            </div>
                                                                            <div class="timeline-panel text-muted">
                                                                                <h6 class="mb-0">Weaning</h6>
                                                                                @foreach(\App\Models\Weaning::where('litter_no', $litter->litter_no)->get() as $weaning)
                                                                                    <table>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">DATE</td>
                                                                                            <td class="p-2">{{ $weaning->date }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">NO.</td>
                                                                                            <td class="p-2">{{ $weaning->number }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="p-2 font-weight-bold">AVE. WEIGHT</td>
                                                                                            <td class="p-2">{{ $weaning->weight }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                @endforeach
                                                                                @if(! \App\Models\Weaning::where('litter_no', $litter->litter_no)->first())
                                                                                    <p class="text-muted">no schedule yet</p>
                                                                                @endif
                                                                                <button type="button" id="editWeaningBtn" class="btn btn-link" data-litter_no="{{ $litter->litter_no }}" data-weaning="{{ json_encode(\App\Models\Weaning::where('litter_no', $litter->litter_no)->first()) }}">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="timeline-badge success">
                                                                            </div>
                                                                            <div class="timeline-panel text-muted" href="#">
                                                                                <h6 class="mb-0">Remarks</h6>
                                                                                @if(\App\Models\Remark::where('litter_no', $litter->litter_no)->count() == 0)
                                                                                    <div class="form-group">
                                                                                        <form id="editRemarksForm">
                                                                                            @csrf
                                                                                            <textarea name="remarks" class="form-control"></textarea>
                                                                                            <input type="hidden" name="litter_no" value="{{ $litter->litter_no }}">
                                                                                            <button type="submit" class="btn btn-light mt-2">Save Remarks</button>
                                                                                        </form>
                                                                                    </div>
                                                                                @else
                                                                                    @php
                                                                                        $remarks = \App\Models\Remark::where('litter_no', $litter->litter_no)->first();
                                                                                    @endphp
                                                                                    {{ $remarks->remarks }} <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#editRemarks{{ $litter->litter_no }}"><i class="fa fa-edit"></i></button>
                                                                                    <div class="collapse" id="editRemarks{{ $litter->litter_no }}">
                                                                                        <div class="form-group">
                                                                                            <form id="editRemarksForm">
                                                                                                @csrf
                                                                                                <textarea name="remarks" class="form-control">{{ $remarks->remarks }}</textarea>
                                                                                                <input type="hidden" name="litter_no" value="{{ $litter->litter_no }}">
                                                                                                <button type="submit" class="btn btn-light mt-2">Save Remarks</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <button id="addNewSetBtn" type="button" class="btn btn-link mt-2 mb-2">
                                    <i class="fa fa-plus"></i> Add New Set
                                </button>
                            </div>
                            <div class="tab-pane fade" id="feeding">
                                <h5 class="font-weight-bold text-uppercase text-center">Breeding to Gestation</h5>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="card">
                                            <div class="card-header font-weight-bold">
                                                Duration (Day 1-30)
                                                <button type="button" id="GDD1D30Btn" data-pig_id="{{ $pig->id }}" data-bgd1d31="{{ json_encode(\App\Models\BGD1D30::where('pig_id', $pig->id)->first()) }}" class="btn btn-link float-right">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <table class="table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <td class="text-center">Day</td>
                                                    <td class="text-center">Time</td>
                                                    <td class="text-center">Feed Amount</td>
                                                    <td class="text-center">Feed Type</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\BGD1D30::where('pig_id', $pig->id)->get() as $bgd1d30)
                                                    <tr>
                                                        <td class="text-center">{{ $bgd1d30->day }}</td>
                                                        <td class="text-center">{{ \Illuminate\Support\Carbon::parse($bgd1d30->time)->format('h:i A') }}</td>
                                                        <td class="text-center">{{ $bgd1d30->feed_amount }}</td>
                                                        <td class="text-center">{{ $bgd1d30->feed_type }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="card">
                                            <div class="card-header font-weight-bold">
                                                Duration (Day 31-70)
                                                <button type="button" id="GDD31D70Btn" data-pig_id="{{ $pig->id }}" data-bgd31d70="{{ json_encode(\App\Models\BGD31D70::where('pig_id', $pig->id)->first()) }}" class="btn btn-link float-right">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <table class="table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <td class="text-center">Day</td>
                                                    <td class="text-center">Time</td>
                                                    <td class="text-center">Feed Amount</td>
                                                    <td class="text-center">Feed Type</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\BGD31D70::where('pig_id', $pig->id)->get() as $bgd31d70)
                                                    <tr>
                                                        <td class="text-center">{{ $bgd31d70->day }}</td>
                                                        <td class="text-center">{{ \Illuminate\Support\Carbon::parse($bgd31d70->time)->format('h:i A') }}</td>
                                                        <td class="text-center">{{ $bgd31d70->feed_amount }}</td>
                                                        <td class="text-center">{{ $bgd31d70->feed_type }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="card">
                                            <div class="card-header font-weight-bold">
                                                Duration (Day 71-100)
                                                <button type="button" id="GDD71D100Btn" data-pig_id="{{ $pig->id }}" data-bgd71d100="{{ json_encode(\App\Models\BGD71D100::where('pig_id', $pig->id)->first()) }}" class="btn btn-link float-right">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <table class="table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <td class="text-center">Day</td>
                                                    <td class="text-center">Time</td>
                                                    <td class="text-center">Feed Amount</td>
                                                    <td class="text-center">Feed Type</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\BGD71D100::where('pig_id', $pig->id)->get() as $bgd71d100)
                                                    <tr>
                                                        <td class="text-center">{{ $bgd71d100->day }}</td>
                                                        <td class="text-center">{{ \Illuminate\Support\Carbon::parse($bgd71d100->time)->format('h:i A') }}</td>
                                                        <td class="text-center">{{ $bgd71d100->feed_amount }}</td>
                                                        <td class="text-center">{{ $bgd71d100->feed_type }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Boar</label>
                        <select name="boar" class="form-control">
                            @foreach(\App\Models\Pig::where('type', 'Boar')->get() as $boar)
                                <option value="{{ $boar->pig_no }}">{{ $boar->pig_no }}</option>
                            @endforeach
                        </select>
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

    <div id="editMatingModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editMatingForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mating Schedule</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Boar</label>
                        <select name="boar" class="form-control">
                            @foreach(\App\Models\Pig::where('type', 'Boar')->get() as $boar)
                                <option value="{{ $boar->pig_no }}">{{ $boar->pig_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editFarrowingModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editFarrowingForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Farrowing Schedule</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Actual Date</label>
                        <input type="date" name="actual_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ave. Weight</label>
                        <input type="text" name="weight" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">Foster MI -/+</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Alive <strong>(+)</strong></label>
                                    <input type="number" name="alive" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Dead <strong>(-)</strong></label>
                                    <input type="number" name="dead" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>From/To Sow <small>(Optional)</small></label>
                        <select name="sow" class="form-control">
                            @foreach(\App\Models\Pig::where('type', 'Sow')->get() as $sow)
                                <option value="">-- select --</option>
                                <option value="{{ $sow->pig_no }}">{{ $sow->pig_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="litter_no">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editWeaningModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editWeaningFom" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Weaning Schedule</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No.</label>
                        <input type="number" name="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ave. Weight</label>
                        <input type="number" name="weight" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="litter_no">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="BGD1D30Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="BGD1D30Form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Breeding to Gestation (Day 1 - 30)
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Day</label>
                        <select name="day" class="form-control">
                            <option value="">-- select --</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Amount</label>
                        <input type="text" name="feed_amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Type</label>
                        <input type="text" name="feed_type" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pig_id" value="{{ $pig->id }}">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="BGD31D70Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="BGD31D70Form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Breeding to Gestation (Day 31 - 70)
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Day</label>
                        <select name="day" class="form-control">
                            <option value="">-- select --</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Amount</label>
                        <input type="text" name="feed_amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Type</label>
                        <input type="text" name="feed_type" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pig_id" value="{{ $pig->id }}">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="BGD71D100Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="BGD71D100Form" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Breeding to Gestation (Day 71 - 100)
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Day</label>
                        <select name="day" class="form-control">
                            <option value="">-- select --</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Amount</label>
                        <input type="text" name="feed_amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Feed Type</label>
                        <input type="text" name="feed_type" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pig_id" value="{{ $pig->id }}">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
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
        const pig_id = '{{ $pig->id }}';
    </script>
@endpush
