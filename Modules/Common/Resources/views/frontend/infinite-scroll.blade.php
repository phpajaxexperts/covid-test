@push('js')
<script src="{{ asset('node_modules/blueimp-tmpl/js/tmpl.min.js') }}"></script>
<script src="{{ themes('js/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ themes('js/jquery-ui.scrollAppend.js') }}"></script>
<script>
var infinteScroll = $(window).scrollAppend({
    //url: '{{ url("ad") }}',
    url: '{{ $_SERVER["REQUEST_URI"] }}',
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
@endpush