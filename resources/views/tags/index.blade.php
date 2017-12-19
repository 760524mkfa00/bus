@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Tags
                        @can('create', busRegistration\Tag::class)
                            <a class="float-right btn btn-sm btn-primary" href="{{ route('create_tag') }}">New Tag</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <th>#</th>
                                <th>Tag</th>
                                <th class="float-right">
                                @can('remove', busRegistration\Tag::class)
                                    Remove
                                @endcan
                                </th>
                            </thead>
                            <tbody>
                            @can('remove', busRegistration\Tag::class)
                                @foreach($tags as $tag)
                                    <tr>
                                        <td><strong> {!! $tag->id !!}</strong></td>
                                        <td><strong> {!! $tag->tag !!}</strong></td>
                                        <td>
                                            <a title="Remove" href="{!! URL::route('remove_tag', $tag->id) !!}"
                                                class="float-right"><i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                            @endcan

                            @cannot('remove', busRegistration\Tag::class)
                                @foreach($tags as $tag)
                                    <tr>
                                        <td><strong> {!! $tag->id !!}</strong></td>
                                        <td><strong> {!! $tag->tag !!}</strong></td>
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection