@can('create',busRegistration\Child::class)
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

                <td class="hidden-xs" style="width:2%;">
                    <a title="Edit"
                       href="#"
                       class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                    </a>
                </td>
                <td class="hidden-xs" style="width:2%;">
                    <a title="Remove"
                       href=""
                       class="pull-right"><i class="fa fa-times"></i>
                    </a>
                </td>
        </tr>
    @endforeach
@endcan

@cannot('create',busRegistration\Child::class)
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
        </tr>
    @endforeach
@endcan