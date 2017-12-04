<div class="card">
    <div class="card-header">Parent/Guardian</div>
    <div class="card-body">
        <address>
            <strong>{{ $user->first_name . ' ' . $user->last_name}}</strong>
            <br>{{ $user->address }}
            <br>{{ $user->city . ', ' . $user->province . ' ' . $user->postal_code }}
            <br><abbr title="Primary Phone">P:</abbr>
            {{ $user->primary_phone }}
            @if($user->secondary_phone)
                <br><abbr title="Seconday Phone">S:</abbr>
                {{ $user->secondary_phone }}
            @endif
        </address>
        <address>
            <strong>E-Mail</strong>
            <br>{{ $user->email }}
        </address>

        <!-- <div class="float-right">
            <a href="#" class="btn btn-sm">Edit</a>
        </div> -->
    </div>
</div>