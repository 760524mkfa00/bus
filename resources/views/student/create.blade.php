@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-10">
                <div class="card">
                    <div class="card-header">
                        Student Information
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{!! route('store_student') !!}">
                            {{ csrf_field() }}
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


                                    <div class="form-group{{ $errors->has('grade_id') ? ' has-error' : '' }}">
                                        <label for="grade_id">Grade in coming September</label>

                                        <select id="grade_id" class="form-control" name="grade_id" required>
                                            <option value="" selected disabled hidden>Select Grade</option>
                                            @foreach($grades as $id => $grade)
                                                <option value="{{$id}}">{{$grade}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('grade_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('grade_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('current_school_id') ? ' has-error' : '' }}">
                                        <label for="current_school_id">School they attend now</label>

                                        <select id="current_school_id" class="form-control" name="current_school_id" required>
                                            <option value="" selected disabled hidden>Select School</option>
                                            @foreach($schools as $id => $school)
                                                <option value="{{$id}}">{{$school}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('current_school_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('current_school_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('next_school_id') ? ' has-error' : '' }}">
                                        <label for="next_school_id">School in coming September</label>

                                        <select id="next_school_id" class="form-control" name="next_school_id" required>
                                            <option value="" selected disabled hidden>Select School</option>
                                            @foreach($schools as $id => $school)
                                                <option value="{{$id}}">{{$school}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('next_school_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('next_school_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input id="checkbox1" class="form-check-input" type="checkbox" value="" name="differentAddress">
                                            Different address than Parent/Guardian
                                        </label>
                                    </div>
                                </div>



                                <div class="col">
                                    <div class="address-block form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="display:none">
                                        <label for="address">Address</label>

                                        <input id="address" type="address" class="form-control" name="address"
                                               value="{{ old('address') }}">

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }} address-block" style="display:none">
                                        <label for="city">City</label>

                                        <input id="city" type="city" class="form-control" name="city"
                                               value="{{ old('city') }}">

                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }} address-block" style="display:none">
                                        <label for="province">Province</label>

                                        <input id="province" type="province" class="form-control" name="province"
                                               value="{{ old('province') }}">

                                        @if ($errors->has('province'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }} address-block" style="display:none">
                                        <label for="postal_code">Postal Code</label>

                                        <input id="postal_code" type="postal_code" class="form-control" name="postal_code"
                                               value="{{ old('postal_code') }}">

                                        @if ($errors->has('postal_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                    <div class="form-group{{ $errors->has('international') ? ' has-error' : '' }}">
                                        <label for="international">International</label>

                                        <select id='international' class="form-control" name="international">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>

                                        @if ($errors->has('international'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('international') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('int_start_date') ? ' has-error' : '' }} international-block" style="display:none">
                                        <label for="int_start_date">International Start Date</label>

                                        <input id="int_start_date" type="int_start_date" class="form-control" name="int_start_date"
                                               value="{{ old('int_start_date') }}">

                                        @if ($errors->has('int_start_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('int_start_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('int_end_date') ? ' has-error' : '' }} international-block" style="display:none">
                                        <label for="int_end_date">International End Date</label>

                                        <input id="int_end_date" type="int_end_date" class="form-control" name="int_end_date"
                                               value="{{ old('int_end_date') }}">

                                        @if ($errors->has('int_end_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('int_end_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Register Student
                            </button>
                            <a role="button" href="{{ route('home') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        jQuery(document).ready(function() {
            $('#checkbox1').change(function () {
                if (this.checked)
                //  ^
                    $('.address-block').fadeIn('slow');
                else
                    $('.address-block').fadeOut('slow');
            });


            $('#international').change(function() {
                var select = this.value;
                if (select === 'yes')
                //  ^
                    $('.international-block').fadeIn('slow');
                else
                    $('.international-block').fadeOut('slow');
            })
        });
    </script>

@endsection