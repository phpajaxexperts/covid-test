@isset($images)
@if(count($images)>0)
@push('css')
<link rel="stylesheet" href="{{ themes('blueimp-gallery-lightbox/css/blueimp-gallery.min.css') }}">
@endpush

@push('js')
<script src="{{ themes('blueimp-gallery-lightbox/js/blueimp-gallery.min.js') }}"></script>    
<script>
    document.getElementById('links').onclick = function(event) {
      event = event || window.event
      var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = { index: link, event: event },
        links = this.getElementsByTagName('a')
      blueimp.Gallery(links, options)
    }
  </script>
@endpush

@push('additionalContent')
<!-- The Gallery as lightbox dialog, should be a document body child element -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
  </div>
@endpush

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Images</div>
            <div class="card-body">
                <div class="row" id="links">
                @isset($images)
                    @if(count($images)>0)
                        @foreach ($images as $image)
                            @php( $arr_params = array("img_folder" => $img_folder,'img_optimize_params' => $img_optimize_params,'ID' => $section_rs_ID,'image' => $image->image) )
                            @php( $image_url = imageUrlGenerator($arr_params) )
        
                            <div class="col-sm-3">
                                <div class="item">
                                    <a href="{{$image_url}}" title="{{$image->title}}">
                                    <img src="{{$image_url}}" class="img-thumbnail" alt="{{$image->alt_tag_text}}">
                                    </a>
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
