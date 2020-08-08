@extends('layouts.master')

@isset($center->metaDetails->meta_title)
@section('dynamicMetaTitle'){{$center->metaDetails->meta_title}}@endsection
@endisset

@isset($center->metaDetails->meta_description)
@section('metaDescription'){{$center->metaDetails->meta_description}}@endsection
@endisset

@isset($center->metaDetails->meta_keywords)
@section('metaKeywords'){{$center->metaDetails->meta_keywords}}@endsection
@endisset

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ ucfirst($center->title) }}</h3></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{ $center->description }} 
                        </div>

                        @include('common::frontend.custom-fields')
                    </div>
                </div>
            </div>
        </div>

        @include('common::frontend.images')

        @include('common::frontend.videos')

        @include('common::frontend.files')


    </div>
@endsection
