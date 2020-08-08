@extends('layouts.master')


@push('css')
<link rel="stylesheet" href="{{ themes('blueimp-gallery-lightbox/css/blueimp-gallery.min.css') }}">
@endpush

@push('js')
<script src="{{ themes('blueimp-gallery-lightbox/js/blueimp-gallery.min.js') }}"></script>
<script>
    blueimp.Gallery(document.getElementById('links').getElementsByTagName('a'), {
        container: '#blueimp-gallery-carousel',
        carousel: true,
        fullScreen: false
    })
</script>
@endpush


@section('content')
    <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel" style="width: 940px; height: 448px;padding-bottom:0px;">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <div class="row" id="links" style="display: none;">
        <a href="{{ themes('images/template/slide-2.jpg')  }}" title="Apple">
            <img src="{{ themes('images/template/slide-2.jpg')  }}" alt="Apple" />
        </a>
        <a href="{{ themes('images/template/slide-1.jpg')  }}" title="Orange">
            <img src="{{ themes('images/template/slide-1.jpg')  }}" alt="Orange" />
        </a>
    </div>

    <div class="box-slogan">
        <h3>Welcome to Sameera Maya Kitchen!</h3>
        <p> At vero eos et <a href="#" class="link-1">accusam et</a> justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet lorem ipsum dolor sit amet. </p>
    </div>


    <div class="border-horiz"></div>
    <div class="container_12 row-1">
        <article class="grid_4 thumbnail-1">
            <h3><span>Vegan</span> cookings </h3>
            <figure class="box-img"><img src="{{ themes('images/template/page1-img1.jpg')  }}" alt=""></figure>
            <p><a href="#" class="link-1">Click here</a> for more info about this free template created by TemplateMonster.com team.</p>
            <a href="#" class="btn">Read more</a> </article>
        <article class="grid_4 thumbnail-1">
            <h3><span>grill</span> cookings </h3>
            <figure class="box-img"><img src="{{ themes('images/template/page1-img2.jpg')  }}" alt=""></figure>
            <p>This web template is optimized for 1280X1024 screen resolution. It is also XHTML &amp; CSS valid.</p>
            <a href="#" class="btn">Read more</a> </article>
        <article class="grid_4 thumbnail-1">
            <h3><span>dessert</span> cookings </h3>
            <figure class="box-img"><img src="{{ themes('images/template/page1-img3.jpg')  }}" alt=""></figure>
            <p>The PSD source files of this template are available for free for the registered members.</p>
            <a href="#" class="btn">Read more</a> </article>
        <div class="clear"></div>
    </div>
    <div class="border-horiz"></div>
    <div class="container_12">
        <article class="grid_4">
            <h3>popular</h3>
            <ul class="list-popular">
                <li> <a href="#">Lighter cooking</a>
                    <p>At vero eos et accusam etusto dolores et ea rebum.</p>
                </li>
                <li> <a href="#">Pudding</a>
                    <p>Duis autem vel eum iriure dolor in hendrerit.</p>
                </li>
                <li> <a href="#">Black bean salsa</a>
                    <p>Molestie consequat, vel illum dolore eu feugiat.</p>
                </li>
                <li> <a href="#">Asparagus</a>
                    <p>Vulputate velit esse molestie consequat.</p>
                </li>
            </ul>
        </article>
        <article class="grid_8">
            <h3>Professional programs</h3>
            <blockquote class="quote-1"> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquym erat, sed diam voluptua At vero eos. </blockquote>
            <div class="name-author">- James Willis</div>
            <ul class="list-dropcap">
                <li>
                    <div class="wrapper">
                        <div class="dropcap">A</div>
                        <a href="#">Lorpsum dolor</a> </div>
                    <figure class="box-img"><img src="{{ themes('images/template/page1-img4.jpg')  }}" alt=""></figure>
                </li>
                <li>
                    <div class="wrapper">
                        <div class="dropcap">B</div>
                        <a href="#">consetet
                            sadiping </a> </div>
                    <figure class="box-img"><img src="{{ themes('images/template/page1-img5.jpg')  }}" alt=""></figure>
                </li>
                <li>
                    <div class="wrapper">
                        <div class="dropcap">C</div>
                        <a href="#">diam nonumy </a> </div>
                    <figure class="box-img"><img src="{{ themes('images/template/page1-img6.jpg')  }}" alt=""></figure>
                </li>
            </ul>
        </article>
        <div class="clear"></div>
    </div>
    </section>
@endsection