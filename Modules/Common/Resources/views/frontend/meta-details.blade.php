@isset($ad->metaDetails->meta_title)
@section('dynamicMetaTitle'){{$ad->metaDetails->meta_title}}@endsection
@endisset

@isset($ad->metaDetails->meta_description)
@section('metaDescription'){{$ad->metaDetails->meta_description}}@endsection
@endisset

@isset($ad->metaDetails->meta_keywords)
@section('metaKeywords'){{$ad->metaDetails->meta_keywords}}@endsection
@endisset