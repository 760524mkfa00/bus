<div class="card">
    <div class="card-header">
        Students
        {{--@can('create', busRegistration\Child::class)--}}
        {{--<a class="pull-right btn btn-sm btn-primary" href="{{ route('register') }}">New</a>--}}
        {{--@endcan--}}
    </div>
    <div class="card-body">
        <table class="table table-bordered table-sm" id="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Sib</th>
                    <th scope="col">School</th>
                    <th class="nosort" scope="col">Seat</th>
                    <th class="nosort" scope="col">International</th>
                    <th class="nosort" scope="col">Processed</th>
                </tr>
            </thead>
            <tbody>
                @include('student._partials._partials.listLoop')
            </tbody>
        </table>

{{--        {{ $students->links() }}--}}

    </div>
</div>