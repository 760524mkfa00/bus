@can('create',busRegistration\Child::class)
{{--    {{ dd($students->first()) }}--}}
    @foreach($students as $student)
        <tr>
            <td>
                <a title="Edit" href="{{ route('edit_student', [$student->order->id, $student->id]) }}"><strong>{!! $student->fullName() !!}</strong></a><br>
                <span class="small">> {!! $student->order->parent->fullName() !!}</span>
            </td>
            <td><strong>{{ $student->order->parent->siblings }}</strong></td>
            <td>{!! $student->nextSchool->school !!}</td>
            <td>{!! ucfirst($student->seat_assigned) !!}</td>
            <td>{!! ucfirst($student->international) !!}</td>
            <td>{!! ucfirst($student->processed) !!}</td>
        </tr>
    @endforeach
@endcan

{{--@cannot('create',busRegistration\Child::class)--}}
    {{--@foreach($students as $student)--}}
        {{--<tr>--}}
            {{--<td>--}}
                {{--<strong>{!! $student->first_name . ' ' . $student->last_name !!}</strong><br>--}}
                {{--<span class="small">> {!! $student->parent->fullName() !!}</span>--}}
            {{--</td>--}}
            {{--<td><strong> {!! $student->parent->children->count() !!}</strong></td>--}}
            {{--<td>{!! $student->nextSchool->school !!}</td>--}}
            {{--<td>{!! ucfirst($student->seat_assigned) !!}</td>--}}
            {{--<td>{!! ucfirst($student->international) !!}</td>--}}
            {{--<td>{!! ucfirst($student->processed) !!}</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
{{--@endcan--}}