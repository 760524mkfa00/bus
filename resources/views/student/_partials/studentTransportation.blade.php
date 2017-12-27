<div class="card">
    <div class="card-header">Transportation</div>
    <div class="card-body">

        @if(is_array($edulog))
            <h6>Dist: {{ $edulog['0']->StudWalkDistance }} - Elg: {{ $edulog['0']->DispEligibility }}</h6>
            <table class="table">
                <thead>
                <th>Direction</th>
                <th>Stop Description</th>
                <th>Time</th>
                <th>Bus</th>
                </thead>
                <tbody>
                @foreach($edulog as $trip)
                    <tr>
                        <td>{{ $trip->BusStopDesc ?? '' }}</td>
                        <td>{{ $trip->BusStop ?? '' }}</td>
                        <td>{{ $trip->DispTimeAtStop ?? ''}}</td>
                        <td>{{ $trip->BusNum ?? ''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
