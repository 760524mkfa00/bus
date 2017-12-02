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
                        <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="year" value="2017">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name">First Name</label>

                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}" required autofocus>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="last_name">Last Name</label>

                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}" required autofocus>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">E-Mail Address</label>

                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email-confirm">Confirm E-Mail</label>

                                        <input id="email-confirm" type="email" class="form-control"
                                               name="email_confirmation" required>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">Password</label>

                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>

                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>


                                </div>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('primary_phone') ? ' has-error' : '' }}">
                                        <label for="primary_phone">Primary Phone</label>

                                        <input id="primary_phone" type="primary_phone" class="form-control" name="primary_phone"
                                               value="{{ old('primary_phone') }}" required>

                                        @if ($errors->has('primary_phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('primary_phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('secondary_phone') ? ' has-error' : '' }}">
                                        <label for="secondary_phone">Secondary Phone</label>

                                        <input id="secondary_phone" type="secondary_phone" class="form-control" name="secondary_phone"
                                               value="{{ old('secondary_phone') }}" required>

                                        @if ($errors->has('secondary_phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('secondary_phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address">Address</label>

                                        <input id="address" type="address" class="form-control" name="address"
                                               value="{{ old('address') }}" required>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label for="city">City</label>

                                        <input id="city" type="city" class="form-control" name="city"
                                               value="{{ old('city') }}" required>

                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                                        <label for="province">Province</label>

                                        <input id="province" type="province" class="form-control" name="province"
                                               value="{{ old('province') }}" required>

                                        @if ($errors->has('province'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                        <label for="postal_code">Postal Code</label>

                                        <input id="postal_code" type="postal_code" class="form-control" name="postal_code"
                                               value="{{ old('postal_code') }}" required>

                                        @if ($errors->has('postal_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection