@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Grades
                        @can('create', busRegistration\Grade::class)
                            <a class="float-right btn btn-sm btn-primary" href="{{ route('create_grade') }}">New Grade</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <th>#</th>
                                <th>Grade</th>
                                <th class="float-right">
                                @can('remove', busRegistration\Grade::class)
                                    Remove
                                @endcan
                                </th>
                            </thead>
                            <tbody>
                                @foreach($grading as $grade)
                                    <tr>
                                        <td><strong> {!! $grade->id !!}</strong></td>
                                        <td><strong> {!! $grade->grade !!}</strong></td>
                                        <td>
                                            @can('remove', $grade)
                                                <a title="Remove" href="{!! URL::route('remove_grade', $grade->id) !!}"
                                                    class="float-right"><i class="fa fa-times"></i>
                                                <a>
                                            @endcan
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection