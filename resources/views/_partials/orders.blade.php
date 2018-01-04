<div class="card">
    <div class="card-header">Invoice Amounts</div>
    <div class="card-body">
        <table class="table">
            <thead class="table-dark">
                <th>Reg #</th>
                <th>Students</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Outstanding</th>
                <th>Next Payment Date</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($user->order as $order)
                    <tr>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->children->count() }}</td>
                        <td>$ {{ number_format($order->netAmount(), 2) }}</td>
                        <td>$ {{ number_format($order->paid_amount ?? 0, 2)  }}</td>
                        <td>$ {{ number_format($order->netAmount() - $order->paid_amount ?? 0, 2)  }}</td>
                        <td>Next payment due or paid in full</td>
                        <td><a role="button" href="{{ route('begin_payment', $order->id) }}" class="btn btn-outline-primary btn-sm">Begin Payment</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>