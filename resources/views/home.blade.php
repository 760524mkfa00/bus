@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-lg-start">
            <div class="col col-lg-3">
                @include('_partials/parentAddress')
            </div>

            <div class="col col-lg-9">
                @include('_partials/students')
            </div>
        </div>
    </div>
@endsection