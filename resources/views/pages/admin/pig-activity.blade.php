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
                            @if($pig->type == 'Sow')
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#breeding">Breeding</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{ $pig->type != 'Sow' ? 'active' : '' }}" data-toggle="tab" href="#feeding">Feeding</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @if($pig->type == 'Sow')
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
                            @endif
                            <div class="tab-pane fade {{ $pig->type != 'Sow' ? 'show active' : '' }}" id="feeding">
                                @if($pig->type == 'Sow')
                                    <table class="table table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center" rowspan="1" colspan="1">Stage</th>
                                            <th class="text-center" rowspan="1" colspan="3">Breeding to Gestation</th>
                                            <th class="text-center" rowspan="1" colspan="4">Gestation to Weaning</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Duration</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 1-30</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 31-70</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 71-100</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 100 - Farrowing</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 1 After Farrow</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 2 - 4</td>
                                            <td class="text-center" rowspan="1" colspan="1">Day 4 - 28</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Feed Type</td>
                                            <td class="text-center" rowspan="1" colspan="3">Breeder</td>
                                            <td class="text-center" rowspan="1" colspan="4">Lactating</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Feed Amount</td>
                                            <td class="text-center" rowspan="1" colspan="1">1.5kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">3.0-3.5kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">2.5-3.0kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">3.0-3.5kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">1.0-1.5kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">2.0-2.5kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">5-6kgs</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @elseif($pig->type == 'Gilt')
                                    <table class="table table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center" rowspan="1" colspan="1">Stage</th>
                                            <th class="text-center" rowspan="1" colspan="2">Growing to Breeding</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Duration</td>
                                            <td class="text-center" rowspan="1" colspan="1">124-153</td>
                                            <td class="text-center" rowspan="1" colspan="1">154 - Heat Day</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Feed Tyoe</td>
                                            <td class="text-center" rowspan="1" colspan="1">Grower</td>
                                            <td class="text-center" rowspan="1" colspan="1">Breeder</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" rowspan="1" colspan="1">Feed Amount</td>
                                            <td class="text-center" rowspan="1" colspan="1">2.0kgs</td>
                                            <td class="text-center" rowspan="1" colspan="1">2.0kgs</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @elseif($pig->type == 'Boar')
                                        <table class="table table-bordered" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th class="text-center" class="text-center" rowspan="1" colspan="1">Stage</th>
                                                <th class="text-center" class="text-center" rowspan="1" colspan="2">Growing to Breeding</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">Duration</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">124-153</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">154-Onwards</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">Feed Type</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">Grower</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">Breeder</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">Feed Amount</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">2.0kgs</td>
                                                <td class="text-center" class="text-center" rowspan="1" colspan="1">1.5-2.0kgs</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                @elseif($pig->type == 'Piglet')
                                    <table class="table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center" colspan="1" rowspan="1">Feed Type</th>
                                            <th class="text-center" colspan="4" rowspan="1">Booster</th>
                                            <th class="text-center" colspan="1" rowspan="1">Hog Prestart</th>
                                            <th class="text-center" colspan="1" rowspan="1">Starter</th>
                                            <th class="text-center" colspan="1" rowspan="1">Grower</th>
                                            <th class="text-center" colspan="1" rowspan="1">Finisher</th>
                                            <th class="text-center" colspan="1" rowspan="1">Expected Date to be Sold</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center" colspan="1" rowspan="1">Duration</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 7</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 15</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 22</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 29</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 29</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 36</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 46</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 81</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 124</td>
                                            <td class="text-center" colspan="1" rowspan="1">Day 144</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" colspan="1" rowspan="1">Feed Amount</td>
                                            <td class="text-center" colspan="1" rowspan="1">20g</td>
                                            <td class="text-center" colspan="1" rowspan="1">50g</td>
                                            <td class="text-center" colspan="1" rowspan="1">100g</td>
                                            <td class="text-center" colspan="1" rowspan="1">300g</td>
                                            <td class="text-center" colspan="1" rowspan="1">600g</td>
                                            <td class="text-center" colspan="1" rowspan="1">1kg</td>
                                            <td class="text-center" colspan="1" rowspan="1">2kg</td>
                                            <td class="text-center" colspan="1" rowspan="1">2.2</td>
                                            <td class="text-center" colspan="1" rowspan="1"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
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
