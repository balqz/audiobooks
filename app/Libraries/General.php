<?php
use App\Libraries\General;
// use App\Libraries\Config;
use App\Category;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request; 
use illuminate\config; 

namespace App\Libraries;
class General 
{
    function url_api_path(){
		return Config('app.url_api').'public/assets/upload/';
	}
	function public_path(){
		return public_path().'/assets/upload/';
	}
}