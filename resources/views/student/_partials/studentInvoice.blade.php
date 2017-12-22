<div class="card">
    <div class="card-header">Invoices</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Reason</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Outstanding</th>
            </thead>
            <tbody>
                @foreach($user->children as $child)
                    <tr>
                        <td>{{ $child->fullName() }}</td>
                        <td>{{ $child->amount }}</td>
                        <td>{{ $child->discount_amount }}%</td>
                        <td>{{ $child->discount->discount ?? '' }}</td>
                        <td>{{ $child->netAmount() }}</td>
                        <td></td>
                        <td>{{ $child->totalOutstanding() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>