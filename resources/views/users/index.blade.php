@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Users
                        @can('create', busRegistration\User::class)
                            <a class="pull-right btn btn-sm btn-primary" href="{{ route('register') }}">New</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead class="thead-grey">
                            <th scope="col">Employee #</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Route</th>
                            <th scope="col">User Role</th>
                            @can('update', busRegistration\User::class)
                                <th scope="col" class="nosort">Edit</th>
                            @endcan
                            @can('update', busRegistration\User::class)
                                <th scope="col" class="nosort">Remove</th>
                            @endcan
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><strong> {!! $user->employee_number !!}</strong></td>
                                    <td><strong> {!! $user->first_name !!}</strong></td>
                                    <td><strong> {!! $user->last_name !!}</strong></td>
                                    <td><strong> {!! $user->email !!}</strong></td>
                                    <td>{!! $user->route->route_number ?? '' !!}</td>
                                    <td>{!! $user->roles->first()->name ?? NULL !!}</td>
                                    @can('update',$user)
                                        <td class="hidden-xs" style="width:2%;">
                                            <a title="Edit"
                                               href="{!! URL::route('update_user', $user->id) !!}"
                                               class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
                                            </a>
                                        </td>
                                    @endcan
                                    @can('update',$user)
                                        <td class="hidden-xs" style="width:2%;">
                                            <a title="Remove"
                                               href="{!! URL::route('remove_user', $user->id) !!}"
                                               class="pull-right"><i class="fa fa-times"></i>
                                                </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

    <script>
        $(document).ready(function () {

            $(function () {
                $('#table').DataTable({
                    dom: 'Bfrtip',
                    aoColumnDefs: [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }],
                    buttons: [
                        'pageLength',
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4 ]
                            },
                            customize : function(doc) {
                                // doc.pageMargins = [10, 10, 10,10 ];
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            }
                        },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4 ]
                            },
                            customize: function ( win ) {
                                $(win.document.body)
                                    .css( 'font-size', '10pt' )
                                    .prepend(
                                        '<img src="https://www.busboss.com/hubfs/layout-2017/home/block1-bus.png" style="position:absolute; top:0; right:0; opacity: .1; width: 400px;" />'
                                    );

                                $(win.document.body).find( 'table' )
                                    .addClass( 'compact table-sm' )
                                    .css( 'font-size', 'inherit' );
                            }
                        }
                    ],
                    paging: true,
                    pageLength: 120,
                    lengthMenu: [
                        [15, 30, 60, 120, -1],
                        ['15 Rows', '30 Rows', '60 Rows', '120 Rows', 'Show All']
                    ]
                });
            });
        });
    </script>

@endsection