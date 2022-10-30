@extends('layouts.main')
@section('content')
    <div class="container-fluid">

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

    </div>
@endsection
