@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-10">
                <div class="card">
                    <div class="card-header">
                        Parent/Guardian Information
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('update_user', $user->id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="year" value="2017">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name">First Name</label>

                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ $user->first_name }}" required autofocus>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="last_name">Last Name</label>

                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ $user->last_name }}" required autofocus>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">E-Mail Address</label>

                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ $user->email }}" required>

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
                                            <option value="no" {!! $user->active == 'no' ? 'selected="selected"' : ''  !!}>
                                                No
                                            </option>
                                            <option value="yes" {!! $user->active == 'yes' ? 'selected="selected"' : ''  !!}>
                                                Yes
                                            </option>
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('primary_phone') ? ' has-error' : '' }}">
                                        <label for="primary_phone">Primary Phone</label>

                                        <input id="primary_phone" type="primary_phone" class="form-control"
                                               name="primary_phone"
                                               value="{{ $user->primary_phone }}" required>

                                        @if ($errors->has('primary_phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('primary_phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('secondary_phone') ? ' has-error' : '' }}">
                                        <label for="secondary_phone">Secondary Phone</label>

                                        <input id="secondary_phone" type="secondary_phone" class="form-control"
                                               name="secondary_phone"
                                               value="{{ $user->secondary_phone }}" required>

                                        @if ($errors->has('secondary_phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('secondary_phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address">Address</label>

                                        <input id="address" type="address" class="form-control" name="address"
                                               value="{{ $user->address }}" required>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label for="city">City</label>

                                        <input id="city" type="city" class="form-control" name="city"
                                               value="{{ $user->city }}" required>

                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label for="province">Province</label>

                                        <input id="province" type="province" class="form-control" name="province"
                                               value="{{ $user->province }}" required>

                                        @if ($errors->has('province'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                        <label for="postal_code">Postal Code</label>

                                        <input id="postal_code" type="postal_code" class="form-control"
                                               name="postal_code"
                                               value="{{ $user->postal_code }}" required>

                                        @if ($errors->has('postal_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
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