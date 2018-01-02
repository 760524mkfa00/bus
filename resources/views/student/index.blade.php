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
                    aoColumnDefs: [{
                        'bSortable': false,
                        'aTargets': ['nosort']
                    }]
                });
            });

            $( "#created_at" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
@endsection