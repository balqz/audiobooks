<?php namespace App\Http\Controllers;

use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Input;
use App\User;

class AuthenticateController extends Controller
{
    public function login()    {
        // grab credentials from the request
        // $credentials = Request::json()->all();
		$cred = Input::only('email','password');
	    try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($cred)) {
				return ResponseUtil::json(					
                    '',
                    'Wrong email or password',
                    'invalid_credentials',
                    401
                );
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return ResponseUtil::json(
                '',
                'Oops, somwthing\'s wrong, please try again later',
                'could_not_create_token',
                500
            );
        }
		$id = Auth::id();
		$user = User::find($id);
		if(isset($user)){
			$res = array('id'=>$user->id,
						 'role'=>$user->role
						);
			$merg = array_merge($res,$cred);
			$result = ResponseUtil::json($merg,'success','berhasil');
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
		// all good so return the token
        return $result;
    }
	
	public function store()
    {
        // grab credentials from the request
        $credentials = Request::json()->all();
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return ResponseUtil::json(
                    '',
                    'Wrong email or password',
                    'invalid_credentials',
                    401
                );
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return ResponseUtil::json(
                '',
                'Oops, somwthing\'s wrong, please try again later',
                'could_not_create_token',
                500
            );
        }

        // all good so return the token
        return ResponseUtil::json(compact('token'));
    }	
}