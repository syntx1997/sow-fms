@extends('layouts.main')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-header text-center">
                <strong>Feeding Guide for Piglet/Fattener</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center">Feed Type</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">On Day</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="1" rowspan="4" class="text-center">Booster</td>
                        <td colspan="1" class="text-center">20 grams</td>
                        <td colspan="1" class="text-center">Day 7</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">50 grams</td>
                        <td colspan="1" class="text-center">Day 15</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">100 grams</td>
                        <td colspan="1" class="text-center">Day 22</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">300grams</td>
                        <td colspan="1" class="text-center">Day 29</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">Hog PreStart</td>
                        <td colspan="1" class="text-center">600 grams</td>
                        <td colspan="1" class="text-center">Day 36</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">Starter</td>
                        <td colspan="1" class="text-center">1 kilogram</td>
                        <td colspan="1" class="text-center">Day 46</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">Grower</td>
                        <td colspan="1" class="text-center">2 kilograms</td>
                        <td colspan="1" class="text-center">Day 81</td>
                    </tr>
                    <tr>
                        <td colspan="1" class="text-center">Finisher</td>
                        <td colspan="1" class="text-center">2.20 kilograms</td>
                        <td colspan="1" class="text-center">Day 124</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">Expected to be Sold</td>
                        <td colspan="1" class="text-center">Day 114</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <strong>Medication Guide</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center">Medication</th>
                        <th class="text-center">On Day</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">First Injection of Iron</td>
                        <td class="text-center">Day 3</td>
                    </tr>
                    <tr>
                        <td class="text-center">Second Injection of Iron</td>
                        <td class="text-center" rowspan="2">Day 10</td>
                    </tr>
                    <tr>
                        <td class="text-center">Castration(Kapon)</td>
                    </tr>
                    <tr>
                        <td class="text-center">1st Deworming</td>
                        <td class="text-center">Day 35</td>
                    </tr>
                    <tr>
                        <td class="text-center">2nd Deworming</td>
                        <td class="text-center">Day 75</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
