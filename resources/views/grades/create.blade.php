@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-3">
                <div class="card">
                    <div class="card-header">
                        Create Grade
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_grade') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                                <label for="grade">Enter Grade Name</label>

                                <input id="grade" type="text" class="form-control" name="grade" required>

                                @if ($errors->has('grade'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <a href="{{ route('list_grade') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection