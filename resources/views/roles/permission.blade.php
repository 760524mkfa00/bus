@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Permission for {!! $role->name !!}
                    </div>
                    <div class="card-body">
                        <form role="form" method="POST" action="{{ route('store_permission',$role->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
                                <label for="permissions">Enter Permission</label>
                                <input id="permissions" type="permissions" class="form-control" name="permissions" required>
                                @if ($errors->has('permissions'))
                                    <span class="help-block"><strong>{{ $errors->first('permissions') }}</strong></span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection