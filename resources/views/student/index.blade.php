@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-2">
                @include('student._partials.studentFilter')
            </div>
            <div class="col-10">
                @include('student._partials.studentList')
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
                        // {
                        //     extend: 'pdfHtml5',
                        //     orientation: 'landscape',
                        //     pageSize: 'LEGAL',
                        //     exportOptions: {
                        //         columns: [ 0, 1, 2, 3 ]
                        //     },
                        //     customize : function(doc) {
                        //         // doc.pageMargins = [10, 10, 10,10 ];
                        //         doc.content[1].table.widths =
                        //             Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        //     }
                        // },
                        {
                            extend: 'print',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
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
                        },  'csv'
                    ],
                    paging: true,
                    pageLength: 30,
                    lengthMenu: [
                        [15, 30, 60, 120, -1],
                        ['15 Rows', '30 Rows', '60 Rows', '120 Rows', 'Show All']
                    ]
                });
            });

            $( "#created_at" ).datepicker({
                dateFormat: "yy-mm-dd"
            });

        });
    </script>

@endsection