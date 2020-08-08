@extends('layouts.master')


@push('css')

@endpush

@push('js')
{{--<script src="{{ themes('blueimp-gallery-lightbox/js/blueimp-gallery.min.js') }}"></script>--}}
{{--<script>--}}
    {{--blueimp.Gallery(document.getElementById('links').getElementsByTagName('a'), {--}}
        {{--container: '#blueimp-gallery-carousel',--}}
        {{--carousel: true,--}}
        {{--fullScreen: false--}}
    {{--})--}}
{{--</script>--}}
@endpush


@section('content')

    <div class="row">
        <div class="col-md-12 text-center mt-4"><h1>COVID-19 Drive-Thru Testing</h1></div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <strong>By Appointment Only</strong><br><br>

            Price: <strong>RM 300 Nett</strong><br><br>

            <ul>
                <li>MoH accredited rt-PCR test</li>
                <li>Aim to have the results ready within 48 hours **</li>
            </ul>

            <i>** May be subjected to delays if surge in demand</i><br><br>

            <strong>IMPORTANT MESSAGE :</strong> If you display any symptoms such as fever, cough and sore throat AND have been in contact with a CONFIRMED case of COVID-19, please proceed to the nearest public healthcare facility for screening and management.

            For more information please refer to FAQ
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <button type="button" class="btn btn-default">Book Test</button>
        </div>
    </div>

@endsection