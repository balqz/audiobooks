<?php namespace App\Http\Controllers;

use App\Category;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;
use Input;
use Illuminate\Support\Facades\Config;
use File;
use Image; 

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /categories
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Category::query()));
    }

  
    /**
     * Store a newly created resource in storage.
     * POST /categories
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /categories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
		$data_categories = Category::find($id);
	    $get_listcat = Category::with('child')->where('parent_id',0)->whereNull('deleted_at')->get();
		//var_dump($get_listcat);die;
		if(isset($get_listcat)){
			$res = ApiUtils::get(Category::query(), $id);
			$result = ResponseUtil::json($get_listcat,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	  /**
     * Show the form for creating a new resource.
     * GET /categories/create
     *
     * @return Response
     */
   
	public function create()
    {
       	// store
		$category = new Category;
		$category->title      	= Input::get('title');
		$category->subtitle 	= Input::get('subtitle');
		$category->about 		= Input::get('about');
		if(Input::has('parent_id')){
				$ids  = Input::get('parent_id');
				$category->parent_id = $ids;
		}
		$category->save();
		if(isset($category)){
			if(Input::file('picture_url'))
			{
				$categories = 'categories';
				$files = Input::file('picture_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path = public_path().'/assets/upload/'.$categories.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$category->picture_url = $filename;
					$category->save();				
				}			
			}					
			$result = ResponseUtil::json($category,'data tersimpan','success');
		}else{
			$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
		}
        return $result;
    }
    /**
     * Show the form for editing the specified resource.
     * GET /categories/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {       
		// store
		$category = Category::find($id);
		if(isset($category)){
			$category->title 				= ( Input::get('title') ? Input::get('title') : $category->title ); 
			$category->subtitle 			= ( Input::get('subtitle') ? Input::get('subtitle') : $category->subtitle ); 
			$category->about 				= ( Input::get('about') ? Input::get('about') : $category->about ); 
			if(Input::has('parent_id')){
					$ids  = Input::get('parent_id');
					$category->parent_id = $ids;
			}
			$category->updated_at 			=  date('Y-m-d H:i:s');
			$category->save();
			if(isset($category)){
				if(Input::file('picture_url'))
				{
					$categories = 'categories';
					$files = Input::file('picture_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path = public_path().'/assets/upload/'.$categories.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$category->picture_url = $filename;
						$category->save();				
					}			
				}
				$result = ResponseUtil::json($category,'berhasil','success');					
			}else{
				$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
			}
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
		return $result;
    }

    /**
     * Update the specified resource in storage.
     * PUT /categories/{id}
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
     * DELETE /categories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}