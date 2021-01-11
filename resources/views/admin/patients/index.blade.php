@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Patients
                    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary float-right">Add</a>
                </div>
                <div class="card-body">
                    @if (count($users) === 0)
                    <p>No patients available</p>
                    @else
                    <table id="table-users" class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                            <tr data-id="{{ $user->id }}">
                                <td>{{ $user->name }} @if(Auth::user()->id == $user->id) (You) @endif</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('admin.patients.show', $user->id) }}" class="btn btn-default">View</a>
                                    <a href="{{ route('admin.patients.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                    <form style="display:inline-block" method="POST" action="{{ route('admin.patients.destroy', $user->id) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="form-control btn btn-danger">Delete</button>
                                    </form>
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