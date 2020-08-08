@extends('layouts.master')

@push('css')
<style></style>
@endpush

@push('js')
<script src="{{ asset('node_modules/blueimp-tmpl/js/tmpl.min.js') }}"></script>
<script src="{{ themes('js/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ themes('js/jquery-ui.scrollAppend.js') }}"></script>
<script>
var infinteScroll = $(window).scrollAppend({
    url: '{{ url("patients") }}',
    //url: '{{ $_SERVER["REQUEST_URI"] }}',
	params: { request_type: "paging",sort_by: $('#sort_by').val() },
	appendTo: "#divItems",
	footerClass: "#divFooter"
});

function getSortBy(sort_by){
    infinteScroll.scrollAppend('setPage',0);
    infinteScroll.scrollAppend('setSortBy',sort_by);
    infinteScroll.scrollAppend('append');
    //test.append();
}
</script>
<script type="text/x-tmpl" id="tmpl-item-grid">
    {% for (var i=0; i<o.items.length; i++) { %}
    <div class="col-sm-3 p-2">
        <div class="item"><img src="{%=o.items[i].image_url%}" class="img-thumbnail"></div>
        <div class="text-center mt-2">
            <a href="{{ url('/patients/detail/{%=o.items[i].ID%}') }}" title="{%=o.items[i].title%}">
                {%=o.items[i].title%}
            </a>
        </div>
    </div>
    {% } %}
</script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            Sort By : 
            <select name="sort_by" id="sort_by" onchange="getSortBy(this.value);">
                <option value="recent">Recently Added</option>
                <option value="A-Z">Title A-Z</option>
                <option value="Z-A">Title Z-A</option>
            </select>
        </div>

        <div class="row" id="divItems">
            @isset($patients)
                @foreach($patients as $item)
                        @php( $arr_params = array("img_folder" => $img_folder,'img_optimize_params' => $img_optimize_params,'ID' => $item->ID,'image' => isset($item->primaryimage->image)?$item->primaryimage->image:'') )
                        @php( $image_url = imageUrlGenerator($arr_params) )
                        <div class="col-sm-3 p-2">
                            <div class="item">
                                <a href="{{ url('/patient/detail/' . $item->ID) }}" title="Patient">
                                    @if(isset($item->primaryimage->image))
                                    <img src="{{$image_url}}" class="img-thumbnail">
                                    @else
                                    <img src="{{ asset('img-opt/images/noimage.jpg'.$img_optimize_params) }}" class="img-thumbnail">
                                    @endif
                                </a>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{ url('/patients/detail/' . $item->ID) }}" title="patients">
                                {{ $item->title }}
                                </a>
                            </div>
                        </div>
                @endforeach
            @endisset
        </div>

    <div class="row" style="display:none;">
        <div class="col-sm-12 text-center mt-4">
            <div class="col-sm-6 text-center">
            <?
            $links = $patients->links();
            $patterns = array();
            $patterns[] = '/'.$patients->currentPage().'\?page=/';
            $replacements = array();
            $replacements[] = '';
            echo preg_replace($patterns, $replacements, $links);
            ?>
            </div>
        </div>
    </div>
    </div>
@endsection
