<div class="card">
    <div class="card-header">
        Filters
    </div>
    <div class="card-body">

        <form action="">
            <h6><strong>Phone Search</strong></h6>

            <div class="form-group" style="margin-bottom: 0.5rem;">
                <input type="text" class="form-control" placeholder="Phone" name="phone"  value="{{ \Session::get('searchValues')['phone'] ?? '' }}">
            </div>

            <h6><strong>Options</strong></h6>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="seat">
                    <option value="" {!! \Session::get('searchValues')['seat'] == '' ? 'selected="selected"' : ''  !!}>Seat</option>
                    <option value="yes" {!! \Session::get('searchValues')['seat'] == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                    <option value="no" {!! \Session::get('searchValues')['seat'] == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="paid">
                    <option value="" {!! \Session::get('searchValues')['paid'] == '' ? 'selected="selected"' : ''  !!}>Paid</option>
                    <option value="yes" {!! \Session::get('searchValues')['paid'] == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                    <option value="no" {!! \Session::get('searchValues')['paid'] == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="subsidy">
                    <option value="" {!! \Session::get('searchValues')['subsidy'] == '' ? 'selected="selected"' : ''  !!}>Subsidy</option>
                    <option value="yes" {!! \Session::get('searchValues')['subsidy'] == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                    <option value="no" {!! \Session::get('searchValues')['subsidy'] == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="international">
                    <option value="" {!! \Session::get('searchValues')['international'] == '' ? 'selected="selected"' : ''  !!}>International</option>
                    <option value="yes" {!! \Session::get('searchValues')['international'] == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                    <option value="no" {!! \Session::get('searchValues')['international'] == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="processed">
                    <option value="" {!! \Session::get('searchValues')['processed'] == '' ? 'selected="selected"' : ''  !!}>Processed</option>
                    <option value="yes" {!! \Session::get('searchValues')['processed'] == 'yes' ? 'selected="selected"' : ''  !!}>Yes</option>
                    <option value="no" {!! \Session::get('searchValues')['processed'] == 'no' ? 'selected="selected"' : ''  !!}>No</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <select class="form-control" name="tag">
                    <option value="" selected>Tag</option>
                    @foreach($tagList as $id => $tag)
                        <option value="{{ $id }}" {!! \Session::get('searchValues')['tag'] == $id ? 'selected="selected"' : ''  !!}>{{ $tag }}</option>
                    @endforeach
                </select>
            </div>

            <h6><strong>Date</strong></h6>
            <div class="form-group" style="margin-bottom: 0.5rem;">
                <input type="text" class="form-control" placeholder="Created Date" name="created_at" id="created_at">
            </div>
            {{--<div class="form-group" style="margin-bottom: 0.5rem;">--}}
                {{--<input type="text" class="form-control" placeholder="Notification Date" name="notification_date">--}}
            {{--</div>--}}

            <button type="submit" class="btn btn-primary btn-sm float-right">
                Update
            </button>
            <a role="button" href="#" class="btn btn-primary btn-sm">
                Clear
            </a>
        </form>



    </div>
</div>