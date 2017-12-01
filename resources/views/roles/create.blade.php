@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Role
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_role') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Enter Role Name</label>

                                <input id="name" type="name" class="form-control" name="name" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <a href="{{ route('list_role') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection