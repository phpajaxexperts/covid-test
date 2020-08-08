@extends('layouts.master')

@section('content')
<div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <p>
                   <h1>Welcome to Sameera Maya Kitchen</h1>
                    Our channel entertain you with village food, country foods, street foods and traditional food cooking.
                </p>
                <p>
                    Nulla tincidunt sit amet ligula interdum pulvinar. Sed nec volutpat enim. Praesent pretium
                    ullamcorper
                    quam, at rhoncus magna consectetur quis. Nulla condimentum, libero vel varius sodales, lacus urna
                    accumsan purus, at
                    mattis nisi nibh in lorem. Sed laoreet, ante vitae tincidunt auctor, sapien metus tincidunt ante,
                    quis aliquam lacus risus id quam.
                </p>
                <h3>Free HTML5 Templates</h3>
                <p>
                    Nam vehicula viverra quam, nec ornare ex convallis eget. Praesent pulvinar, justo at lacinia
                    elementum, dolor elit facilisis massa, vel feugiat elit massa et libero. Praesent hendrerit metus eu
                    elementum commodo. Morbi tempus mi a nulla scelerisque, vitae vulputate nisi commodo. Maecenas felis
                    urna, dictum quis mollis quis, mollis vel ligula. Nullam sodales sapien tellus, ornare tincidunt
                    dolor imperdiet at. Vestibulum convallis, felis quis condimentum finibus, justo lectus aliquam
                    libero, eu lacinia tellus leo eu orci.
                </p>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, modi!</li>
                    <li>Ea iure at, debitis culpa perspiciatis suscipit laudantium a, expedita.</li>
                    <li>Voluptate distinctio perspiciatis cum sed ipsum nisi accusantium a aut!</li>
                    <li>Sed vel quo dignissimos, quaerat totam officia, deserunt provident minus.</li>
                </ul>
                <p>
                    Maecenas consequat dictum aliquam. Praesent nec magna at ipsum facilisis dictum sit amet nec arcu.
                    Donec ac metus a elit rhoncus euismod et sit amet velit. Nunc quis lacus vel metus tincidunt
                    vulputate in et libero. Aliquam dolor lacus, facilisis ultrices rutrum in, blandit vitae nulla.
                    Nullam vestibulum, odio vitae aliquam aliquam, nibh dui iaculis augue, ut tristique nisi est in
                    tellus. Fusce volutpat ultricies venenatis. In a arcu in tellus tincidunt accumsan. Nulla pretium at
                    ex viverra vulputate. Cras mollis velit metus, non suscipit felis luctus sit amet. Ut vel leo vitae
                    magna blandit tempor in sit amet arcu. Donec dignissim mattis dui. Donec ultrices malesuada sapien,
                    ut fermentum nisi efficitur eu. Phasellus dui eros, posuere vel lacus vitae, venenatis feugiat
                    libero. Nunc sed nisi feugiat, consequat arcu id, vehicula augue. Donec viverra tincidunt nisi eget
                    ornare.
                </p>
            </div>
            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">
                    <a href="{{ url('/samayal') }}" class="fh5co_tagg">samayal</a>
                    <a href="{{ url('/cooking') }}" class="fh5co_tagg">cooking</a>
                    <a href="{{ url('/deshi-food') }}" class="fh5co_tagg">deshi food</a>
                    <a href="{{ url('/fish') }}" class="fh5co_tagg">fish</a>
                    <a href="{{ url('/cake') }}" class="fh5co_tagg">cake</a>
                    <a href="{{ url('/sweet') }}" class="fh5co_tagg">sweet</a>
                    <a href="{{ url('/mutton') }}" class="fh5co_tagg">mutton</a>
                    <a href="{{ url('/chicken') }}" class="fh5co_tagg">chicken</a>
                    <a href="{{ url('/gulapjamoon') }}" class="fh5co_tagg">gulapjamoon</a>
                    <a href="{{ url('/vatlappam') }}" class="fh5co_tagg">vatlappam</a>
                    <a href="{{ url('/chutney') }}" class="fh5co_tagg">chutney</a>
                    <a href="{{ url('/biryani') }}" class="fh5co_tagg">biryani</a>
                </div>


                @include('popular')

            </div>
        </div>
    </div>
</div>

@include('trending')

@endsection