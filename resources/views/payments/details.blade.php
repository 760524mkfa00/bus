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

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('submit_payment', $order->id) }}">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col">
                                        <h2>Billing Address</h2>

                                        <div class="form-group{{ $errors->has('billing_first_name') ? ' has-error' : '' }}">
                                            <label for="billing_first_name">First Name</label>

                                            <input id="billing_first_name" type="text" class="form-control" name="billing_first_name"
                                                   value="{{ old('billing_first_name', $parent->billing_first_name) }}" required autofocus>

                                            @if ($errors->has('billing_first_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_first_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_last_name') ? ' has-error' : '' }}">
                                            <label for="billing_last_name">Last Name</label>

                                            <input id="billing_last_name" type="text" class="form-control" name="billing_last_name"
                                                   value="{{ old('billing_last_name', $parent->billing_last_name) }}" required autofocus>

                                            @if ($errors->has('billing_last_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_last_name') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_address_number') ? ' has-error' : '' }}">
                                            <label for="billing_address_number">Property Number</label>

                                            <input id="billing_address_number" type="text" class="form-control" name="billing_address_number"
                                                   value="{{ old('billing_address_number', $parent->billing_address_number) }}" required>

                                            @if ($errors->has('billing_address_number'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_address_number') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('billing_address_street') ? ' has-error' : '' }}">
                                            <label for="billing_address_street">Property Street</label>

                                            <input id="billing_address_street" type="text" class="form-control" name="billing_address_street"
                                                   value="{{ old('billing_address_street', $parent->billing_address_street) }}" required>

                                            @if ($errors->has('billing_address_street'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('billing_address_street') }}</strong>
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
                                        <div class="col">
                                            <div class="col">
                                                <br />
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="paymentOption" id="full" value="full" checked>
                                                    <label class="form-check-label" for="full">
                                                        Make full payment of $ {{ number_format($options['full'], 2) }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="paymentOption" id="split" value="split">
                                                    <label class="form-check-label" for="split">
                                                        Two payments of $ {{ number_format($options['split'], 2) }} (Today then {{ $options['plusMonth'] }})
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="paymentOption" id="multiple" value="multiple">
                                                    <label class="form-check-label" for="multiple">
                                                        {{ $options['multipleMonths'] }} Monthly payments of $ {{ number_format($options['multiple'], 2) }}
                                                    </label>
                                                </div>
                                                <br />
                                            </div>
                                        </div>


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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="expdate">EXPIRATION DATE</label>
                                                    <select name="expiry_month" class="form-control" id="expiry_month">
                                                        <option value="01">01 - January</option>
                                                        <option value="02">02 - February</option>
                                                        <option value="03">03 - March</option>
                                                        <option value="04">04 - April</option>
                                                        <option value="05">05 - May</option>
                                                        <option value="06">06 - June</option>
                                                        <option value="07">07 - July</option>
                                                        <option value="08">08 - August</option>
                                                        <option value="09">09 - September</option>
                                                        <option value="10">10 - October</option>
                                                        <option value="11">11 - November</option>
                                                        <option value="12">12 - December</option>
                                                    </select>
                                                    <br />
                                                    <select name="expiry_year" class="form-control" id="expiry_year">
                                                        <?php
                                                        $year = (int) date('Y');
                                                        for ($i = $year; $i < $year + 20; $i++ ): ?>
                                                        <option value="<?= substr((string) $i, -2); ?>"><?= $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
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