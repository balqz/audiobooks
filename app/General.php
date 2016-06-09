<?php
use App\General;
use App\Category;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request; 

namespace App\General;
class General 
{
    function url_api_path(){
		return	Config::get('app.url_api').'assets/upload/';
	}
}