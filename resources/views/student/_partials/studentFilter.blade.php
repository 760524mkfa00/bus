<div class="card">
    <div class="card-header">
        Filters
    </div>
    <div class="card-body">

        <h6><strong>Text Filter</strong></h6>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ request()->input('first_name') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Last Name" name="last_name"  value="{{ request()->input('last_name') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Student #" name="student_number"  value="{{ request()->input('student_number') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Parent First" name="parent_first_name"  value="{{ request()->input('parent_first_name') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Parent Last" name="parent_last_name"  value="{{ request()->input('parent_last_name') }}">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Phone" name="phone"  value="{{ request()->input('phone') }}">
        </div>

        <h6><strong>Options</strong></h6>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>Seat</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>Paid</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>Subsidy</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>International</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>Processed</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <select class="form-control">
                <option selected>Tag</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
        </div>

        <h6><strong>Date</strong></h6>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Created Date" name="first_name">
        </div>
        <div class="form-group" style="margin-bottom: 0.5rem;">
            <input type="text" class="form-control" placeholder="Notification Date" name="last_name">
        </div>

        <button type="submit" class="btn btn-primary btn-sm float-right">
            Update
        </button>
        <a role="button" href="#" class="btn btn-primary btn-sm">
            Clear
        </a>

    </div>
</div>