@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-md-12">
                <div class="card">
                    <div class="card-header">
                        Enter a payment details
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('pre_auth', $order->id) }}">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col">
                                        <h2>Billing Address</h2>

                                        <div class="form-group{{ $errors->has('card_name') ? ' has-error' : '' }}">
                                            <label for="card_name">Name on Card</label>

                                            <input id="card_name" type="text" class="form-control" name="card_name"
                                                   value="{{ old('card_name', $parent->card_name) }}" required autofocus>

                                            @if ($errors->has('card_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('card_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>



                                        <div class="form-group{{ $errors->has('billing_address') ? ' has-error' : '' }}">
                                            <label for="billing_address">Address</label>

                                            <input id="billing_address" type="text" class="form-control" name="billing_address"
                                                   value="{{ old('billing_address', $parent->billing_address) }}" required>

                                            @if ($errors->has('billing_address'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_address') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_city') ? ' has-error' : '' }}">
                                            <label for="billing_city">City</label>

                                            <input id="billing_city" type="text" class="form-control" name="billing_city"
                                                   value="{{ old('billing_city', $parent->billing_city) }}" required>

                                            @if ($errors->has('billing_city'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_city') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_province') ? ' has-error' : '' }}">
                                            <label for="billing_province">Province</label>

                                            <input id="billing_province" type="text" class="form-control" name="billing_province"
                                                   value="{{ old('billing_province', $parent->billing_province) }}" required>

                                            @if ($errors->has('billing_province'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_province') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_postal_code') ? ' has-error' : '' }}">
                                            <label for="billing_postal_code">Postal Code</label>

                                            <input id="billing_postal_code" type="text" class="form-control" name="billing_postal_code"
                                                   value="{{ old('billing_postal_code', $parent->billing_postal_code) }}" required>

                                            @if ($errors->has('billing_postal_code'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_postal_code') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email">E-Mail Address</label>

                                            <input id="email" type="email" class="form-control" name="email"
                                                   value="{{ old('email', $parent->email) }}" required>

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

                                    </div>



                                    <div class="col">
                                        <h2>Your Payment Details</h2>

                                        Payment Options (Full / Two payment 30 days apart / 10 Equal Payments)

                                        <div class="form-group{{ $errors->has('pan') ? ' has-error' : '' }}">
                                            <label for="pan">CARD NUMBER</label>
                                            <div class="input-group">
                                                <input id="pan" type="text" class="form-control" name="pan" placeholder="Valid Card Number" required>
                                                <span class="input-group-addon" id="basic-addon2" style="color: purple;"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                            </div>
                                            @if ($errors->has('pan'))
                                                <span class="help-block">
                                                     <strong>{{ $errors->first('pan') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group{{ $errors->has('expdate') ? ' has-error' : '' }}">
                                                    <label for="expdate">EXPIRATION DATE</label>
                                                        <input id="expdate" type="text" class="form-control" name="expdate" placeholder="MM/YY" required>
                                                    @if ($errors->has('expdate'))
                                                        <span class="help-block">
                                                     <strong>{{ $errors->first('expdate') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group{{ $errors->has('cvc') ? ' has-error' : '' }}">
                                                    <label for="cvc">CVC CODE</label>
                                                        <input id="cvc" type="text" class="form-control" name="cvc" placeholder="CVC" required>
                                                    @if ($errors->has('cvc'))
                                                        <span class="help-block">
                                                     <strong>{{ $errors->first('cvc') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    Review Payment
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            {{--<a href="{{ route('list_role') }}" class="btn btn-primary">--}}
                                {{--Cancel--}}
                            {{--</a>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection