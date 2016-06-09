<?php namespace App\Http\Controllers;

use App\Libraries\General;
use App\Collection;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Http\Requests;
use Input;
use File;
use Image;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request; 

class CollectionsController extends Controller
{
	public function __construct(){
        $this->general = New General;
    }
    /**
     * Display a listing of the resource.
     * GET /collections
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Collection::query()));
    }

    /**
     * Show the form for creating a new resource.
     * GET /collections/create
     *
     * @return Response
     */
    public function create()
    {
       	// store
		$collection = new Collection;
		$collection->title      = Input::get('title');
		$collection->subtitle 	= Input::get('subtitle');
		$collection->about 		= Input::get('about');
		$collection->visibility = Input::get('visibility');
		$collection->save();
		if(isset($collection)){
			if(Input::file('picture_url'))
			{
				$collections = 'collections';
				$files = Input::file('picture_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->public_path().$collections.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$collection->picture_url = $filename;
					$collection->save();				
				}			
			}					
			$result = ResponseUtil::json($collection,'data tersimpan','success');
		}else{
			$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
		}
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     * POST /collections
     *
     * @return Response
     */
    public function store()
    {
        //
    }
	
	public function viewall()
    {	
        $collection = ApiUtils::getList(Collection::query())->ToArray();
		$arr_val = array();
		foreach($collection as $val){
			$collections = 'collections';
			$picture_url = $val['picture_url'] != NULL ? $this->general->url_api_path().$collections.'/'.$val['picture_url'] : '';
			
			$arr_val[] = array('id'=>$val['id'],
								 'title'=>$val['title'],	
								 'subtitle'=>$val['subtitle'],	
								 'about'=>$val['about'],	
								 'picture_url'=>$picture_url,	
								 'visibility'=>$val['visibility'],	
								 'updated_at'=>$val['updated_at'],	
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
     * Display the specified resource.
     * GET /collections/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        // return ResponseUtil::json(ApiUtils::get(Collection::query(), $id));
		$data_collection = ApiUtils::get(Collection::query(), $id)->ToArray();
		if(!isset($data_collection)){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}else{
			$collections = 'collections';
			$picture_url = $data_collection['picture_url'] != NULL ? $this->general->url_api_path().$collections.'/'.$data_collection['picture_url'] : '';
			
			$arr_val[] = array('id'=>$data_collection['id'],
								 'title'=>$data_collection['title'],	
								 'subtitle'=>$data_collection['subtitle'],	
								 'about'=>$data_collection['about'],	
								 'picture_url'=>$picture_url,	
								 'visibility'=>$data_collection['visibility'],	
								 'updated_at'=>$data_collection['updated_at'],	
								 );  
			if(isset($arr_val)){			
				$result = ResponseUtil::json($arr_val,'berhasil','success');
				
			}else{
				$result = ResponseUtil::json('','tidak ada data','failed',201);
			}			
		}
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     * GET /collections/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
       // store
		$collection = Collection::find($id);
		if(isset($collection)){
			$collection->title 				= ( Input::get('title') ? Input::get('title') : $collection->title ); 
			$collection->subtitle 			= ( Input::get('subtitle') ? Input::get('subtitle') : $collection->subtitle ); 
			$collection->about 				= ( Input::get('about') ? Input::get('about') : $collection->about ); 
			$collection->visibility 		= ( Input::get('visibility') ? Input::get('visibility') : $collection->visibility ); 
			$collection->updated_at 			=  date('Y-m-d H:i:s');
			$collection->save();
			if(isset($collection)){
				if(Input::file('picture_url'))
				{
					$collections = 'collections';
					$files = Input::file('picture_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->public_path().$collections.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$collection->picture_url = $filename;
						$collection->save();				
					}			
				}
				$result = ResponseUtil::json($collection,'berhasil','success');					
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
     * PUT /collections/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }
	
	public function delete($id)
    {
        $collection = Collection::find($id);
		if(isset($collection)){
			$collection->delete();
			//restore();
			$result = ResponseUtil::json($collection,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	
    /**
     * Remove the specified resource from storage.
     * DELETE /collections/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}