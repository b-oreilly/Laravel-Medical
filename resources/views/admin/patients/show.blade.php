@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Patient: {{ $user->name }} @if(Auth::user()->id == $user->id) (You) @endif
                </div>
                <div class="card-body">

                    <table id="table-users" class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Patient Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ $user->mobile_number }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            @if($user->patient && $user->patient->has_insurance)
                            <tr>
                                <td>Insurance Company</td>
                                <td>{{ $user->patient->insurance_company }}</td>
                            </tr>
                            <tr>
                                <td>Insurance Policy Number</td>
                                <td>{{ $user->patient->policy_number }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>Insurance Details</td>
                                <td>You have no insurance</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ route('patient.patients.index', $user->id) }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Visits
                </div>
                <div class="card-body">
                    @if (count($visits) === 0)
                    <p>No visits available</p>
                    @else
                    <table id="table-visits" class="table table-hover">
                        <thead>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Duration</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                            <tr data-id="{{ $visit->id }}">
                                <td>{{ $visit->date }}</td>
                                <td>Dr. {{ $visit->doctor->user->first_name }} {{ $visit->doctor->user->last_name }}</td>
                                <td>{{ $visit->duration}} minutes</td>
                                <td>
                                    @if($visit->cancelled) <span class="badge badge-danger" style="padding: 10px;margin: 0 5px">CANCELLED</span>
                                    @else <a href="{{ route('patient.visits.show', $visit->id) }}" class="btn btn-primary">View</a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection