<?php

namespace App\Http\Controllers\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopLeftLinksController extends Controller
{
    public function place_advert(){
        return view('site.place-adverts');
    }
}
