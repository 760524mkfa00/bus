<div class="card">
    <div class="card-header">
        Students
        {{--@can('create', busRegistration\User::class)--}}
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
            @can('update', busRegistration\Student::class)
                <th scope="col" class="nosort">Edit</th>
            @endcan
            @can('update', busRegistration\Student::class)
                <th scope="col" class="nosort">Remove</th>
            @endcan
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>
                        <strong>{!! $student->first_name . ' ' . $student->last_name !!}</strong><br>
                        <span class="small">> {!! $student->parent->fullName() !!}</span>
                    </td>
                    <td><strong> {!! $student->parent->children->count() !!}</strong></td>
                    <td>{!! $student->nextSchool->school !!}</td>
                    <td>{!! ucfirst($student->seat_assigned) !!}</td>
                    <td>{!! ucfirst($student->international) !!}</td>
                    <td>{!! ucfirst($student->processed) !!}</td>
                    @can('update',$student)
                        <td class="hidden-xs" style="width:2%;">
                            <a title="Edit"
                               href="{!! URL::route('update_user', $user->id) !!}"
                               class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                            </a>
                        </td>
                    @endcan
                    @can('update',$student)
                        <td class="hidden-xs" style="width:2%;">
                            <a title="Remove"
                               href="{!! URL::route('remove_user', $user->id) !!}"
                               class="pull-right"><i class="fa fa-times"></i>
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>