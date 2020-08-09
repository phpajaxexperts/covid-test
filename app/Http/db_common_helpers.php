<?php
use Illuminate\Support\Facades\DB;
use Modules\Cooking\Entities\Recipe;

function getModuleSortTypes($type){
    $sort_types = DB::table('core_sort_type')
        ->select('ID','name', 'name_short_code')
        ->where([
            ['type', '=' , $type],
            ['active', '=' , 1],
        ])
        ->get();
    return $sort_types;
}


function getCategory($ID) {
    $category = DB::table('core_category')
        ->where('core_category.ID','=',$ID)
        ->get()->first();
    return $category;
}

function getAllCategories() {
    $categories = DB::table('core_category')->get();
    return $categories;
}

function getCategories($parentid=0,$typeid='') {
    $categories = DB::table('core_category')
        ->select('core_category.*')
        ->leftJoin('core_category_mapping','core_category_mapping.category','=','core_category.ID')
        ->where('core_category_mapping.parent','=',$parentid)
        ->where('core_category_mapping.module','=',$typeid)
        //->groupBy('core_category_mapping.category')
        //->toSql();
        ->get();
    //echo $categories; exit;
    //$categories = DB::table('core_category')->where('core_category.active','=',1)->get();
    return $categories;
}

function getLanguages()
{
    $languages = DB::table('core_languages')
        ->where('core_languages.active', 1)
        ->get();
    return $languages;
}

function getDays()
{
    $days = DB::table('core_days')
        ->where('core_days.active', 1)
        ->get();
    return $days;
}

function getCenters($testType)
{
    if($testType=='pre-screening')
        $testType = 1;
    elseif($testType=='point-of-entry-test')
        $testType = 2;

    $days = DB::table('centers')
        ->where('centers.active', 1)
        ->where('centers.process_type', $testType)
        ->get();
    return $days;
}

function getCountries()
{
    $countries = DB::table('core_country')
        ->where('core_country.active', 1)
        ->get();
    return $countries;
}

function getHoursOfOperation($centerID)
{
    $hours = DB::table('centers_hours_of_operation')
        ->select('centers_hours_of_operation.*','core_days.name as day_name')
        ->join('core_days','core_days.ID','=','centers_hours_of_operation.day')
        ->where('centers_hours_of_operation.center', $centerID)
        //->toSql();
        ->get();
//echo $hours; exit;
    //dd($hours);

    return $hours;
}


function getChildUsers($userid)
{
    $child_users = DB::table('cast_crews')
        ->where('cast_crews.parent', $userid)
        ->get();
    return $child_users;
}

function getUser($userid)
{
    $user = DB::table('cast_crews')
        ->select(
            'cast_crews.*',
            'media.file_name'
        )
        ->leftJoin('media', function ($join) {
            $join->on('media.id', '=', DB::raw('(SELECT media.id FROM media WHERE media.model_type = 1 AND media.model_id = cast_crews.ID ORDER BY media.id ASC LIMIT 1)'));
        })
        ->where('cast_crews.Id', $userid)
        ->first();
    return $user;
}

global $res_count;
function getBinaryTree($userid)
{

    $user = getUser($userid);
    $arr_users_tree[$user->parent]['ID'] = $user->ID;
    $arr_users_tree[$user->parent]['first_name'] = $user->first_name;
    $arr_users_tree[$user->parent]['left_right'] = $user->left_right;

    //echo $user->first_name.'<br>';
    $width = 100;
    $res_count = 1;
    $float = '';
    if($user->left_right=='l')
        $float = 'left';
    elseif($user->left_right=='r')
        $float = 'right';

    $child_users = getChildUsers($userid);
    if(count($child_users)>0){
        $res_count = 2;
        if($userid!=3)
            $div_witdh =  $width/$res_count;
        else
            $div_witdh =  100;
    }else
        $div_witdh =  50;

    if($user->file_name)
        $img = '<img src="'.asset('media/cast/'.$user->file_name).'" height="50" width="50"><br><br>';
    else
        $img = '<img src="'.asset('media/no-image.jpg').'" height="50" width="50"><br><br>';

    //$ling_img = '<img src="'.asset('media/line_bg.gif').'">';

    //echo "<div style='color:#000;width:$div_witdh%;margin-top:10px;text-align:center;float:$float'><div style='border-bottom: 1px solid;margin:2px;'><br><br>$img <h1>$user->first_name</h1><br><br></div>";
    echo "<div style='color:#000;margin-top:10px;text-align:center;float:$float'><div style='border-bottom: 1px solid;margin:2px;'><br><br><a href='?ID=$user->ID'>$img <h1>$user->first_name</h1><br><br></div>";


    if(count($child_users)>0){

        $div_witdh =  $width/$res_count;
        foreach($child_users as $child_user){
//            $child_users_childs = getChildUsers($child_user->ID);
//            if(count($child_users_childs)>0){
//                getBinaryTree($userid);
//            }else{
//                $arr_users_tree[] = $child_user->first_name;
//            }
            getBinaryTree($child_user->ID);

        }
    }
    echo "</div>";
    //echo "<pre>"; print_r($arr_users_tree);
    return $arr_users_tree;
}

function getRecipeByID($ID){
    $section = 30;
    $rs = Recipe::with(['primaryimage' => function ($q) use ($section) {
        $q->where('section', $section);
    }])->where('recipes.ID','=',$ID)->get()->first();

    //dd($rs);

    return $rs;
}

function getHomeTrendingRecipe($limit=5){
    $section = 30;
    $rs = Recipe::with(['primaryimage' => function ($q) use ($section) {
        $q->where('section', $section);
    }])->inRandomOrder()->limit($limit)->get();

    //dd($rs);

    return $rs;
}


function getHomeRecentRecipesVideos($limit=5){
    $section = 30;
    $rs = Recipe::with(['primaryvideo' => function ($q) use ($section) {
        $q->where('section', $section);
    }])->orderBy('created_at','DESC')->limit($limit)->get();

    return $rs;
}

function getHomeRecentModifiedRecipes($limit=10){
    $section = 30;
    $rs = Recipe::with(['primaryimage' => function ($q) use ($section) {
        $q->where('section', $section);
    }])->orderBy('updated_at','DESC')->limit($limit)->get();

    return $rs;
}


?>
