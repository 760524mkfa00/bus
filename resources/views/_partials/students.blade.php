<div class="card">
    <div class="card-header">Students</div>
    <div class="card-body">
        <table class="table">
            <thead class="table-dark">
                <th>Reg #</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>School</th>
                <th>Grade</th>
                <th>Seat Assigned</th>
                <th>Paid</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($user->order as $order)
                    @foreach($order->children as $child)
                        <tr>
                            <td>{{$order->order_number}}</td>
                            <td>{{ $child->first_name }}</td>
                            <td>{{ $child->last_name }}</td>
                            <td>{{ $child->nextSchool->school }}</td>
                            <td>{{ $child->grade->grade }}</td>
                            <td>{{ $child->seat_assigned }}</td>
                            <td>{{ $child->paid }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="">
            <a role="button" href="{{ route('student_create') }}" class="btn btn-outline-primary">Register Student</a>
        </div>
    </div>
</div>