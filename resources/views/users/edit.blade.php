@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-4">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('update_user', $user->id) }}">
                            {{ csrf_field() }}


                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First Name</label>


                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>


                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role">User role</label>

                                <select id="role" class="form-control" name="role" required>
                                    <option value="" selected disabled hidden>Select Role</option>
                                    @foreach($roles as $id => $role)
                                        <option value="{{$id}}" {{ $current->id == $id ? 'selected' : '' }}>{{$role}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                                <label for="role">Active</label>

                                <select id="active" class="form-control" name="active" required>
                                    <option value="no" {!! $user->active == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                                    <option value="yes" {!! $user->active == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection