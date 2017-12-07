<div class="card">
    <div class="card-header">Students</div>
    <div class="card-body">

        <form action="{{ route('update_student', [$user->id, $currentChild->id]) }}" method="post">
            {{ csrf_field() }}
            <select class="form-control col-md-3" name="child_id" onchange="this.form.submit()">
                @foreach($user->children as $child)
                    <option value="{{ $child->id }}" {{ ($child->id === $currentChild->id) ? 'selected' : '' }}>{{ $child->first_name . ' ' . $child->last_name }}</option>
                @endforeach
            </select>
            <hr />
            <div class="row">
                <div class="col-4">
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <input id="first_name" type="text" class="form-control" name="first_name"
                                   value="{{ $currentChild->first_name }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <input id="last_name" type="text" class="form-control" name="last_name"
                                   value="{{ $currentChild->last_name }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input id="address" type="text" class="form-control" name="address"
                                   value="{{ $currentChild->address }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="province" class="col-sm-3 col-form-label">Province</label>
                        <div class="col-sm-9">
                            <input id="province" type="text" class="form-control" name="province"
                                   value="{{ $currentChild->province }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postal_code" class="col-sm-3 col-form-label">Postal Code</label>
                        <div class="col-sm-9">
                            <input id="postal_code" type="text" class="form-control" name="postal_code"
                                   value="{{ $currentChild->postal_code }}" required autofocus>
                        </div>
                    </div>

                </div>

                <div class="col-4">
                    <div class="form-group row">
                        <label for="grade_id" class="col-sm-3 col-form-label">Grade</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="grade_id">
                                @foreach($grades as $id => $grade)
                                    <option value="{{ $id }}" {{ ($id === $currentChild->grade_id) ? 'selected' : '' }}>{{ $grade }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="current_school_id" class="col-sm-3 col-form-label">2016 School</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="current_school_id">
                                @foreach($schools as $key => $value)
                                    <option value="{{ $key }}" {{ ($key == $currentChild->current_school_id) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="next_school_id" class="col-sm-3 col-form-label">2017 School</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="next_school_id">
                                @foreach($schools as $key => $value)
                                    <option value="{{ $key }}" {{ ($key == $currentChild->next_school_id) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="international" class="col-sm-3 col-form-label">international</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="international">
                                <option value="yes" {{ ($currentChild->international === 'yes') ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ ($currentChild->international === 'no') ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group row">
                        <label for="paid" class="col-sm-3 col-form-label">Paid</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="paid">
                                <option value="yes" {{ ($currentChild->paid === 'yes') ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ ($currentChild->paid === 'no') ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="seat_assigned" class="col-sm-3 col-form-label">Seat</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="seat_assigned">
                                <option value="yes" {{ ($currentChild->seat_assigned === 'yes') ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ ($currentChild->seat_assigned === 'no') ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="processed" class="col-sm-3 col-form-label">Processed</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="processed">
                                <option value="yes" {{ ($currentChild->processed === 'yes') ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ ($currentChild->processed === 'no') ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>



    </div>
</div>