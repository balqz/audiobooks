<?php namespace App\Http\Controllers;

use App\Libraries\General;
use App\Category;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Http\Requests;
use Input;
use File;
use Image;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request; 

class CategoriesController extends Controller
{	
	 /**
     * Display a listing of the resource.
     * GET /categories
     *
     * @return Response
     */
	public function __construct(){
        $this->general = New General;
    }
	
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Category::query()));
    }
	
	public function viewall()
    {	
        $get_listcat = Category::with('child')->where('parent_id',0)->whereNull('deleted_at')->get()->ToArray();
		$arr_val = array();
		foreach($get_listcat as $val){
			$categories = 'categories';
			$url_pic = $val['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$val['picture_url'] : '';
			$arr_child = array();
			foreach($val['child'] as $child){
			$url_pic_child = $val['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$child['picture_url'] : '';
			$arr_child[] = array('id'=>$child['id'],
								 'title'=>$child['title'],	
								 'subtitle'=>$child['subtitle'],	
								 'picture_url'=>$url_pic_child,	
								 'about'=>$child['about'],	
								); 
			}
			
			$arr_val[] = array('id'=>$val['id'],
							 'title'=>$val['title'],	
							 'subtitle'=>$val['subtitle'],	
							 'picture_url'=>$url_pic,	
							 'about'=>$val['about'],	
							 'child'=>$arr_child,	
							);  
			
		}
		if(isset($arr_val)){
			$result = ResponseUtil::json($arr_val,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
		return $result;
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
		$get_listcat = Category::with('child')->where('id',$id)->whereNull('deleted_at')->get()->ToArray();
		$arr_val = array();
		foreach($get_listcat as $val){
			$categories = 'categories';
			$url_pic = $val['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$val['picture_url'] : '';
			$arr_child = array();
			foreach($val['child'] as $child){
				$url_pic_child = $val['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$child['picture_url'] : '';
				$arr_child[] = array('id'=>$child['id'],
									 'title'=>$child['title'],	
									 'subtitle'=>$child['subtitle'],	
									 'picture_url'=>$url_pic_child,	
									 'about'=>$child['about'],	
									); 
			}
			
			$arr_val[] = array('id'=>$val['id'],
							 'title'=>$val['title'],	
							 'subtitle'=>$val['subtitle'],	
							 'picture_url'=>$url_pic,	
							 'about'=>$val['about'],	
							 'child'=>$arr_child,	
							);  
			
		}
		if(isset($arr_val)){
			//$res = ApiUtils::get(Category::query(), $id);
			$result = ResponseUtil::json($arr_val,'berhasil','success');
			
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
				$path =  $this->general->public_path().$categories.'/';
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
					$path =  $this->general->public_path().$categories.'/';
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
	
	public function delete($id)
    {
        $list_category = Category::where('id','=', $id)
									->orwhere('parent_id','=',$id)
									->wherenull('deleted_at')
									->get()->ToArray();
		if(count($list_category) == 0){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
		else{
			if(count($list_category) == 1){
				$categories  = Category::find($id);
				if(isset($categories)){
					$categories->delete();				
					$result = ResponseUtil::json($categories,'berhasil','success');						
				}else{
					$result = ResponseUtil::json('','gagal menghapus','failed',201);
				}
			}else{
				foreach($list_category as $key=>$cat)
				{	$categories  = Category::find($cat['id']);
					if(isset($categories)){
						$categories->delete();
						$result = ResponseUtil::json('','berhasil','success');			
					}else{
						$result = ResponseUtil::json('','gagal menghapus','failed',201);
					}
				}				
			}		
		}
		return $result;
    }

}