@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ $user->doctor ? 'Doctor - ' : ''}}{{ $user->name }} @if(Auth::user()->id == $user->id) (You) @endif
                </div>
                <div class="card-body">

                    <table id="table-users" class="table table-hover">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            @if ($user->doctor)
                            <tr>
                                <td>Start Date</td>
                                <td>{{ $user->doctor->start_date }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ route('admin.doctors.index', $user->id) }}" class="btn btn-default">Back</a>
                    <a href="{{ route('admin.doctors.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form style="display:inline-block" method="POST" action="{{ route('admin.doctors.destroy', $user->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="form-control btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Visit Log
                </div>
                <div class="card-body">
                    @if (count($visits) === 0)
                    <p>No visits available</p>
                    @else
                    <table id="table-visits" class="table table-hover">
                        <thead>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                            <tr data-id="{{ $visit->id }}">
                                <td>{{ $visit->date }}@if($visit->cancelled) <span class="badge badge-danger" style="padding: 10px;margin: 0 5px">CANCELLED</span> @endif</td>
                                <td><a href="{{ route('admin.patients.show', $visit->patient->user->id) }}">{{ $visit->patient->user->first_name }} {{ $visit->patient->user->last_name }} </a></td>
                                <td>{{ $visit->duration}} minutes</td>
                                <td><a href="{{ route('admin.visits.show', $visit->id) }}" class="btn btn-primary">View</a></td>
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