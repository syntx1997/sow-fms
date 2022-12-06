@extends('layouts.main')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <strong>{{ $title }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center">Category</th>
                        <th class="text-center">Pig No.</th>
                        <th class="text-center">Treatment/Recommendation</th>
                        <th class="text-center">Suggested Feed Amount / Type</th>
                        <th class="text-center">Start Weight</th>
                        <th class="text-center">End Weight</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

@endsection
