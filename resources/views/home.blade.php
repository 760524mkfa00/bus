@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-lg-start">
            <div class="col col-lg-3">
                <div class="card">
                    <div class="card-header">Parent/Guardian</div>
                    <div class="card-body">
                        <address>
                            <strong>{{ $user->first_name . ' ' . $user->last_name}}</strong>
                            <br>{{ $user->address }}
                            <br>{{ $user->city . ', ' . $user->province . ' ' . $user->postal_code }}
                            <br><abbr title="Primary Phone">P:</abbr>
                            {{ $user->primary_phone }}
                            @if($user->secondary_phone)
                                <br><abbr title="Seconday Phone">S:</abbr>
                                {{ $user->secondary_phone }}
                            @endif
                        </address>
                        <address>
                            <strong>E-Mail</strong>
                            <br>{{ $user->email }}
                        </address>

                        <div class="float-right">
                            <a href="#" class="btn btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-lg-9">
                <div class="card">
                    <div class="card-header">Students</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-dark">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>School</th>
                                <th>Grade</th>
                                <th>Seat Assigned</th>
                                <th>Paid</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($user->children as $child)
                                    <tr>
                                        <td>{{ $child->first_name }}</td>
                                        <td>{{ $child->last_name }}</td>
                                        <td>{{ $child->nextSchool->school }}</td>
                                        <td>{{ $child->grade->grade }}</td>
                                        <td>{{ $child->seat_assigned }}</td>
                                        <td>{{ $child->paid }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="">
                            <a role="button" href="{{ route('student_create') }}" class="btn btn-outline-primary">Register Student</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection