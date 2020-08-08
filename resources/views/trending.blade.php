<div class="container-fluid pb-4 pt-5">

    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
            @php
                $section_config = config('cooking.recipe');
                $section = $section_config['section'];
                $img_folder = $section_config['images'];

                $trending_recipes = getHomeTrendingRecipe();
                $arr_img_opt = array('section' => $section, 'img_size_name' => 'standard', 'img_width' => 250, 'img_height' => 325);
                $img_optimize_params = getCdnImageOptimizeParams($arr_img_opt);
            @endphp

            @if(count($trending_recipes)>0)
                @foreach($trending_recipes as $trending_recipe)
                    @php
                        $arr_params = array("img_folder" => $img_folder,'img_optimize_params' => $img_optimize_params,'ID' => $trending_recipe->ID,'image' => isset($trending_recipe->primaryimage->image)?$trending_recipe->primaryimage->image:'');
                        $image_url = imageUrlGenerator($arr_params);
                    @endphp

                    <div class="item px-2">
                        <div class="fh5co_hover_news_img">
                            <div class="fh5co_news_img">
                                @if(isset($trending_recipe->primaryimage->image))
                                    <img src="{{$image_url}}" class="img-thumbnail">
                                @else
                                    <img src="{{ themes('images/template/science-578x362.jpg')  }}" alt="img"/>
                                @endif
                            </div>
                            <div>
                                <a href="{{ url('recipe/'.urlStringConvert($trending_recipe->slug_text).'/'.$trending_recipe->ID)  }}" class="d-block fh5co_small_post_heading"><span class="">{{$trending_recipe->name}}</span></a>
                                <div class="c_g"><i class="fa fa-clock-o"></i>{{ date('M, d, Y',strtotime($trending_recipe->created_at))  }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>