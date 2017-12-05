@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-md-3">
                <div class="card">
                    <div class="card-header">
                        Create School
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('store_school') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                                <label for="school">Enter School Name</label>

                                <input id="school" type="text" class="form-control" name="school" required>

                                @if ($errors->has('school'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <a href="{{ route('list_school') }}" class="btn btn-primary">
                                Cancel
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection