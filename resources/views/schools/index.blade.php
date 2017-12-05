@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Schools
                        {{--                        @can('create', busRegistration\Role::class)--}}
                        <a class="float-right btn btn-sm btn-primary" href="{{ route('create_school') }}">New School</a>
                        {{--@endcan--}}
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <th>#</th>
                                <th>School</th>
                                <th class="float-right">
                                @can('remove', busRegistration\School::class)
                                    Remove
                                @endcan
                                </th>
                            </thead>
                            <tbody>
                            @can('remove', busRegistration\School::class)
                                @foreach($buildings as $school)
                                    <tr>
                                        <td><strong> {!! $school->id !!}</strong></td>
                                        <td><strong> {!! $school->school !!}</strong></td>
                                        <td>
                                            <a title="Remove" href="{!! URL::route('remove_school', $school->id) !!}"
                                                class="float-right"><i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                            @cannot('remove', busRegistration\School::class)
                                @foreach($buildings as $school)
                                    <tr>
                                        <td><strong> {!! $school->id !!}</strong></td>
                                        <td><strong> {!! $school->school !!}</strong></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endcan
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection