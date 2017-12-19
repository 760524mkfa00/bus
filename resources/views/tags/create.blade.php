@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Tag
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_tag') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                                <label for="tag">Enter Tag</label>

                                <input id="tag" type="text" class="form-control" name="tag" required>

                                @if ($errors->has('tag'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tag') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <a href="{{ route('list_tag') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection