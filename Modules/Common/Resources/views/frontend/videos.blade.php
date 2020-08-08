@isset($videos)
@if(count($videos)>0)
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Videos</div>
            <div class="card-body">
                <div class="row">
                @isset($videos)
                    @if(count($videos)>0)
                    @foreach ($videos as $video)
                        @php( $video_thumb_url = getVideoThumbUrl($video->video_url,$video->type)  )
                        <div class="col-sm-3">
                            <div class="item">
                                <a href="#" data-load-url="{{ url('video-popup/'.$video->ID) }}" data-toggle="modal" data-target="#myModal">
                                    <img src="{{$video_thumb_url}}" class="img-thumbnail">
                                </a>
                                <div class="text-center mt-2 mb-4">
                                    {{$video->title}}<br>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                @endisset
                </div>    
            </div>
        </div>
    </div>
</div>
@endif
@endisset