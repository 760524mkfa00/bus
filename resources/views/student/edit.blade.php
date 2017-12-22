@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-lg-start">
            <div class="col col-lg-3">
                @include('student._partials/parentAddress')
            </div>

            <div class="col col-lg-9">
                @include('student._partials/students')
                <br />
                @include('student._partials/studentInvoice')
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script>
        jQuery(document).ready(function() {
           $('#international').change(function() {
                var select = this.value;
                if (select === 'yes')
                //  ^
                    $('.international-block').fadeIn('slow');
                else
                    $('.international-block').fadeOut('slow');
           });

            $('#processed, #seat-assigned').change(function() {
                var select = this.value;
                var hasSeat = $('#seat-assigned').find(":selected").val();

                if((select == 'yes') && (hasSeat == 'no')) {
                    $('.email-no-seat').fadeIn('slow');
                } else {
                    $('.email-no-seat').fadeOut('slow');
                }
           });

            $('#tag').select2({
                placeholder: 'Choose a tag'
            });


            $('#seat-assigned').change(function() {
                var select = this.value;
                if (select === 'yes')
                    $('.payment-block').fadeIn('slow');
            });

        });



    </script>

@endsection