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
{{--<img src="{!!QrCode::format('png')->generate('This is test QR code by Veera!')!!}">--}}
<div style="margin: 0px auto; padding-top: 100px; width: 1000px;">
{!!QrCode::format('svg')->generate('This is test QR code by Veera!')!!}
</div>
@endsection