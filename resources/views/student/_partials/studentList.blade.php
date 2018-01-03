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
                    <th scope="col">{!! sort_students_by('first_name', 'Name') !!}</th>
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
        <div class="row">
            <div class="col">
                Showing {{($students->currentpage()-1)*$students->perpage()+1}} to {{$students->currentpage()*$students->perpage()}}
                of  {{$students->total()}} entries
            </div>
            <div class="col">
                <span class="float-right">{{ $students->appends($_GET)->links() }}</span>
            </div>
        </div>
    </div>
</div>