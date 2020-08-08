<div>
    <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
</div>

@php
    $section_config = config('cooking.recipe');
    $section = $section_config['section'];
    $img_folder = $section_config['images'];

    $trending_recipes = getHomeTrendingRecipe(3);
    $arr_img_opt = array('section' => $section, 'img_size_name' => 'standard', 'img_width' => 250, 'img_height' => 325);
    $img_optimize_params = getCdnImageOptimizeParams($arr_img_opt);
@endphp

@if(count($trending_recipes)>0)
    @foreach($trending_recipes as $trending_recipe)
        @php
            $arr_params = array("img_folder" => $img_folder,'img_optimize_params' => $img_optimize_params,'ID' => $trending_recipe->ID,'image' => isset($trending_recipe->primaryimage->image)?$trending_recipe->primaryimage->image:'');
            $image_url = imageUrlGenerator($arr_params);
        @endphp

        <div class="row pb-3">
            <div class="col-5">
                @if(isset($trending_recipe->primaryimage->image))
                    <img src="{{$image_url}}" class="fh5co_most_trading">
                @else
                    <img src="{{ themes('images/template/science-578x362.jpg')  }}" class="fh5co_most_trading" alt="img"/>
                @endif
            </div>
            <div class="col-7 paddding">
                <div class="most_fh5co_treding_font"> <a href="{{ url('recipe/'.urlStringConvert($trending_recipe->slug_text).'/'.$trending_recipe->ID)  }}" class="d-block fh5co_small_post_heading"><span class="">{{$trending_recipe->name}}</span></a></div>
                <div class="most_fh5co_treding_font_123"> {{ date('M, d, Y',strtotime($trending_recipe->created_at))  }}</div>
            </div>
        </div>
    @endforeach
@endif
