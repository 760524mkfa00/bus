<div class="card">
    <div class="card-header">Parent/Guardian</div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{!! route('update_parent', $user) !!}">
                    <address>

                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label col-form-label-sm">First Name</label>
                            <div class="col-sm-9">
                                <input id="first_name" type="text" class="form-control form-control-sm" name="first_name"
                                       value="{{ $user->first_name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label col-form-label-sm">Last Name</label>
                            <div class="col-sm-9">
                                <input id="last_name" type="text" class="form-control form-control-sm" name="last_name"
                                       value="{{ $user->last_name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                            <div class="col-sm-9">
                                <input id="address" type="text" class="form-control form-control-sm" name="address"
                                       value="{{ $user->address }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label col-form-label-sm">City</label>
                            <div class="col-sm-9">
                                <input id="city" type="text" class="form-control form-control-sm" name="city"
                                       value="{{ $user->city }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="province" class="col-sm-3 col-form-label col-form-label-sm">Province</label>
                            <div class="col-sm-9">
                                <input id="province" type="text" class="form-control form-control-sm" name="province"
                                       value="{{ $user->province }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postal_code" class="col-sm-3 col-form-label col-form-label-sm">Postal Code</label>
                            <div class="col-sm-9">
                                <input id="postal_code" type="text" class="form-control form-control-sm" name="postal_code"
                                       value="{{ $user->postal_code }}" required autofocus>
                            </div>
                        </div>
                        <hr />
                        <div class="form-group row">
                            <label for="primary_phone" class="col-sm-3 col-form-label col-form-label-sm">Phone A</label>
                            <div class="col-sm-9">
                                <input id="primary_phone" type="text" class="form-control form-control-sm" name="primary_phone"
                                       value="{{ $user->primary_phone }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="secondary_phone" class="col-sm-3 col-form-label col-form-label-sm">Phone B</label>
                            <div class="col-sm-9">
                                <input id="secondary_phone" type="text" class="form-control form-control-sm" name="secondary_phone"
                                       value="{{ $user->secondary_phone }}">
                            </div>
                        </div>
                    </address>
                    <address>
                        <hr />
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label col-form-label-sm">E-Mail</label>
                            <div class="col-sm-9">
                                <input id="email" type="text" class="form-control form-control-sm" name="email"
                                       value="{{ $user->email }}">
                            </div>
                        </div>
                    </address>

                    <button type="submit" class="btn btn-primary btn-sm float-right">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
        <hr />
        <h5 class=""><strong>Notifications</strong></h5>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-sm">
                    @foreach($user->notifications as $notification)
                        <tr>
                            <td class="small">
                                {{ $notification->created_at->toFormattedDateString() . ' | ' . $notification->notification }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
</div>