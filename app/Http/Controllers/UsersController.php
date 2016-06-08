<?php namespace App\Http\Controllers;

use App\User;
use App\Utils\ApiUtils;
use App\Utils\AuthUtils;
use App\Utils\ResponseUtil;
use Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\Builder;
use Input;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        // TODO: Check Admin Only
        if (AuthUtils::authenticate() == NULL) return ResponseUtil::json(
            '',
            'You are unauthorized to access this',
            'unauthorized',
            403
        );
        return ResponseUtil::json(ApiUtils::getList(User::query()));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
       $rules = array(
            'email'   	 => 'required|email|unique:user',
            'password'	 => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
			$result = ResponseUtil::json('','data tidak boleh kosong atau email sudah ada','failed',201);
        } else {
            // store
            $nerd = new User;
            $nerd->email      	= Input::get('email');
            $nerd->password      = bcrypt(Input::get('password'));
            $nerd->name 		 = Input::get('name');
            $nerd->birth_date_at = Input::get('birth_date_at');
            $nerd->phone_number  = Input::get('phone_number');
            $nerd->gender 		 = Input::get('gender');
            $nerd->about 		 = Input::get('about');
            $nerd->website 		 = Input::get('website');
            $nerd->relationship_status 	= Input::get('relationship_status');
            $nerd->location 		 = Input::get('location');
            $nerd->role 			 = Input::get('role');
            $nerd->save();
			if(isset($nerd){
				$result = ResponseUtil::json($nerd,'success','berhasil');
			}else{
				$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
			}
        }
		return $result;
    }
	
	public function view()
    {
        return ResponseUtil::json(ApiUtils::getList(User::query()));
    }
	
	public function viewall()
    {	
		$users = ApiUtils::getList(User::query());
		if(isset($users)){
			$result = ResponseUtil::json($users,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
		return $result;
    }
	
    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        $data = new User();
        $data->fill(request()->json()->all());
        $data->password = Hash::make(request()->json()->all()['password']);
        $data->save();
        return ResponseUtil::json($data);
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
		$data_user = User::find($id);
		if(isset($data_user)){
			$res = ApiUtils::get(User::query(), $id);
			$result = ResponseUtil::json($res,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	
	/* public function show($id)
    {
        return ResponseUtil::json(ApiUtils::get(User::query(), $id));
    } */

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {       
		$data_user = User::find($id);
		if(isset($data_user)){
			// store
			$data_user->email 				 = ( Input::get('email') ? Input::get('email') : $data_user->email ); 
			$data_user->password		  	 = ( Hash::make(Input::get('password')) ? Hash::make(Input::get('password')) : $data_user->password ); 
			$data_user->name 		 		 = ( Input::get('name') ? Input::get('name') : $data_user->name ); 
			$data_user->birth_date_at		 = ( Input::get('birth_date_at') ? Input::get('birth_date_at') : $data_user->birth_date_at ); 
			$data_user->phone_number 		 = ( Input::get('phone_number') ? Input::get('phone_number') : $data_user->phone_number ); 
			$data_user->gender 				 = ( Input::get('gender') ? Input::get('gender') : $data_user->gender ); 
			$data_user->about 				 = ( Input::get('about') ? Input::get('about') : $data_user->about ); 
			$data_user->website 			 = ( Input::get('website') ? Input::get('website') : $data_user->website ); 
			$data_user->relationship_status = ( Input::get('relationship_status') ? Input::get('relationship_status') : $data_user->relationship_status ); 
			$data_user->location 		 	= ( Input::get('location') ? Input::get('location') : $data_user->location ); 
			$data_user->role 			 	= ( Input::get('role') ? Input::get('role') : $data_user->role ); 
			$data_user->updated_at 			=  date('Y-m-d H:i:s');
			$data_user->save();

			$result = ResponseUtil::json($data_user,'data tersimpan','success');			
		}else{
			$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
		}
		return $result;
    }

    /**
     * Update the specified resource in storage.
     * PUT /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data_user = User::find($id);
		if(isset($data_user)){
			$data_user->delete();
			//restore();
			$result = ResponseUtil::json('','berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }

}