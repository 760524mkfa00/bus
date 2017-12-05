<div class="card">
    <div class="card-header">
        Students
        {{--@can('create', busRegistration\Child::class)--}}
        {{--<a class="pull-right btn btn-sm btn-primary" href="{{ route('register') }}">New</a>--}}
        {{--@endcan--}}
    </div>
    <div class="card-body">
        <table class="table table-con" id="table">
            <thead class="thead-grey">
            <th scope="col">Name</th>
            <th scope="col">Sib</th>
            <th scope="col">School</th>
            <th scope="col">Seat</th>
            <th scope="col">International</th>
            <th scope="col">Processed</th>
            @can('create', busRegistration\Child::class)
                <th scope="col" class="nosort">Edit</th>
                <th scope="col" class="nosort">Remove</th>
            @endcan
            </thead>
            <tbody>
                @include('student._partials._partials.listLoop')
            </tbody>
        </table>
    </div>
</div>