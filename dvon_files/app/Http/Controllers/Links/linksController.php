<?php

namespace App\Http\Controllers\Links;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExternalLinks as Links;
class linksController extends Controller
{
    public function detail($link){
        $Links = new Links();
        $single_link = $Links->where('link_name',$link)->first();
        
        return view('site.link-detail',['link'=>$single_link]);
        // return response()->json($single_link);

        // echo $link;
    }
}
