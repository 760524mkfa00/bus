@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-5">
                <div class="card">
                    <div class="card-header">
                        Roles
                        {{--                        @can('create', Fieldtrip\Role::class)--}}
                        <a class="float-right btn btn-sm btn-primary" href="{{ route('create_role') }}">New Role</a>
                        {{--@endcan--}}
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Roles</th>
                            <th class="float-right">
                                @can('removePermission', busRegistration\Role::class)
                                    Remove
                                @endcan
                            </th>
                            </thead>
                            <tbody>
                            @foreach($rolesAll as $role)
                                <tr>
                                    <td><strong> {!! $role->id !!}</strong></td>
                                    <td><strong> {!! $role->name !!}</strong></td>
                                    <td>
                                        @can('createPermission', busRegistration\Role::class)
                                            <a class="float-left btn btn-sm btn-primary"
                                               href="{{ route('create_permission', $role->id) }}">Add Permission</a>
                                        @endcan
                                    </td>
                                    <td></td>
                                </tr>
                                @foreach($role->permissions as $id => $permission)
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{!! $id !!}</td>
                                        <td>
                                            @can('removePermission',$role)
                                                <a title="Remove"
                                                   href="{!! URL::route('remove_permission', [$role->id, $id]) !!}"
                                                   class="float-right"><i class="fa fa-times"></i>
                                                    <a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection