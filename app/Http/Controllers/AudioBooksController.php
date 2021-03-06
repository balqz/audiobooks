<?php namespace App\Http\Controllers;
use App\Libraries\General;
use App\AudioBook;
use App\Category;
use App\User;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;
use Input;
use Illuminate\Support\Facades\Config;
use File;
use Image; 

class AudioBooksController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /audiobooks
     *
     * @return Response
     */
	public function __construct(){
        $this->general = New General;
    }
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(AudioBook::query()));
    }

    /**
     * Store a newly created resource in storage.
     * POST /audiobooks
     *
     * @return Response
     */
    public function store()
    {
        // TODO: Check Admin Only

        $data = new AudioBook();
        $data->fill(request()->json()->all());
        $data->save();
        return ResponseUtil::json($data);
    }

    /**
     * Display the specified resource.
     * GET /audiobooks/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function viewall()
    {	
        $audioBook = ApiUtils::getList(AudioBook::query())->ToArray();
		$arr_val = array();
		foreach($audioBook as $val){
			$audiobook = 'audiobook';
			$audio_file_url = $val['audio_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$val['audio_file_url'] : '';
			$audio_preview_file_url = $val['audio_preview_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$val['audio_preview_file_url'] : '';
			$cover_picture_url = $val['cover_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$val['cover_picture_url'] : '';
			$banner_picture_url = $val['banner_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$val['banner_picture_url'] : '';
			
			$data_category = Category::findorFail($val['category_id']);
			$categories = 'categories';
			$url_pic = $data_category['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$data_category['picture_url'] : '';
			$val_categories[] = array('id'=>$data_category['id'],
								 'title'=>$data_category['title'],	
								 'subtitle'=>$data_category['subtitle'],	
								 'picture_url'=>$url_pic,	
								 'about'=>$data_category['about'],	
								); 
			$data_user = User::findorFail($val['publisher_id']);	
			
			$arr_val[] = array('id'=>$val['id'],
							 'title'=>$val['title'],	
							 'subtitle'=>$val['subtitle'],	
							 'author'=>$val['author'],	
							 'narrator'=>$val['narrator'],	
							 'isbn'=>$val['isbn'],	
							 'price'=>$val['price'],	
							 'about'=>$val['about'],	
							 'audio_file_url'=>$audio_file_url,	
							 'audio_preview_file_url'=>$audio_preview_file_url,	
							 'duration_seconds'=>$val['duration_seconds'],	
							 'cover_picture_url'=>$cover_picture_url,	
							 'banner_picture_url'=>$banner_picture_url,	
							 'copyright_year'=>$val['copyright_year'],	
							 'visibility'=>$val['visibility'],	
							 'released_at'=>$val['released_at'],
							 'category_id'=>$val_categories,	
							 'publisher_id'=>$data_user,
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
	
	public function show($id)
    {
		//$data_audioBook = AudioBook::find($id)->ToArray();
		$data_audioBook = ApiUtils::get(AudioBook::query(), $id)->ToArray();
		if(!isset($data_audioBook)){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}else{
			$audiobook = 'audiobook';
			$audio_file_url = $data_audioBook['audio_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_file_url'] : '';
			$audio_preview_file_url = $data_audioBook['audio_preview_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_preview_file_url'] : '';
			$cover_picture_url = $data_audioBook['cover_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['cover_picture_url'] : '';
			$banner_picture_url = $data_audioBook['banner_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['banner_picture_url'] : '';
			
			$data_category = Category::findorFail($data_audioBook['category_id']);
			$categories = 'categories';
			$url_pic = $data_category['picture_url'] != NULL ? $this->general->url_api_path().$categories.'/'.$data_category['picture_url'] : '';
			$val_categories[] = array('id'=>$data_category['id'],
								 'title'=>$data_category['title'],	
								 'subtitle'=>$data_category['subtitle'],	
								 'picture_url'=>$url_pic,	
								 'about'=>$data_category['about'],	
								); 
			$data_user = User::findorFail($data_audioBook['publisher_id']);			
			$arr_val[] = array('id'=>$data_audioBook['id'],
								 'title'=>$data_audioBook['title'],	
								 'subtitle'=>$data_audioBook['subtitle'],	
								 'author'=>$data_audioBook['author'],	
								 'narrator'=>$data_audioBook['narrator'],	
								 'isbn'=>$data_audioBook['isbn'],	
								 'price'=>$data_audioBook['price'],	
								 'about'=>$data_audioBook['about'],	
								 'audio_file_url'=>$audio_file_url,	
								 'audio_preview_file_url'=>$audio_preview_file_url,	
								 'duration_seconds'=>$data_audioBook['duration_seconds'],	
								 'cover_picture_url'=>$cover_picture_url,	
								 'banner_picture_url'=>$banner_picture_url,	
								 'copyright_year'=>$data_audioBook['copyright_year'],	
								 'visibility'=>$data_audioBook['visibility'],	
								 'released_at'=>$data_audioBook['released_at'],	
								 'category_id'=>$val_categories,	
								 'publisher_id'=>$data_user,	
								 'updated_at'=>$data_audioBook['updated_at'],	
								); 
			if(isset($arr_val)){			
				$result = ResponseUtil::json($arr_val,'berhasil','success');
				
			}else{
				$result = ResponseUtil::json('','tidak ada data','failed',201);
			}			
		}
        return $result;
    }
	
	public function create()
    {
       	// store
		$audioBook = new AudioBook;
		$audioBook->title      	= Input::get('title');
		$audioBook->subtitle 	= Input::get('subtitle');
		$audioBook->author 		 = Input::get('author');
		$audioBook->narrator 	 = Input::get('narrator');
		$audioBook->isbn 		 = Input::get('isbn');
		$audioBook->price 		 = Input::get('price');
		$audioBook->about 		 = Input::get('about');
		$audioBook->duration_seconds = Input::get('duration_seconds');
		$audioBook->copyright_year 	 = Input::get('copyright_year');
		$audioBook->visibility 		 = Input::get('visibility');
		$audioBook->released_at 	 = Input::get('released_at');
		$audioBook->category_id 	 = Input::get('category_id');
		$audioBook->publisher_id 	 = Input::get('publisher_id');
		$audioBook->save();
		if(isset($audioBook)){
			if(Input::file('audio_file_url'))
			{
				$audiobooks = 'audiobook';
				$files = Input::file('audio_file_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->url_api_path().$audiobooks.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audioBook->audio_file_url = $filename;
					$audioBook->save();				
				}			
			}
			if(Input::file('audio_preview_file_url'))
			{
				$audiobooks = 'audiobook';
				$files = Input::file('audio_preview_file_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->url_api_path().$audiobooks.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audioBook->audio_preview_file_url = $filename;
					$audioBook->save();				
				}			
			}
			if(Input::file('cover_picture_url'))
			{
				$audiobooks = 'audiobook';
				$files = Input::file('cover_picture_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->url_api_path().$audiobooks.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audioBook->cover_picture_url = $filename;
					$audioBook->save();				
				}			
			}
			if(Input::file('banner_picture_url'))
			{
				$audiobooks = 'audiobook';
				$files = Input::file('banner_picture_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->url_api_path().$audiobooks.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audioBook->banner_picture_url = $filename;
					$audioBook->save();				
				}			
			}			
			$result = ResponseUtil::json($audioBook,'data tersimpan','success');
		}else{
			$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
		}
        return $result;
    }
	
	public function edit($id)
    {       
		$data_audioBook = AudioBook::find($id);
		if(isset($data_audioBook)){
			// store
			$data_audioBook->title 				= ( Input::get('title') ? Input::get('title') : $data_audioBook->title ); 
			$data_audioBook->subtitle 			= ( Input::get('subtitle') ? Input::get('subtitle') : $data_audioBook->subtitle ); 
			$data_audioBook->author 			= ( Input::get('author') ? Input::get('author') : $data_audioBook->author ); 
			$data_audioBook->narrator 			= ( Input::get('narrator') ? Input::get('narrator') : $data_audioBook->narrator ); 
			$data_audioBook->isbn 				= ( Input::get('isbn') ? Input::get('isbn') : $data_audioBook->isbn ); 
			$data_audioBook->price 				= ( Input::get('price') ? Input::get('price') : $data_audioBook->price ); 
			$data_audioBook->about 				= ( Input::get('about') ? Input::get('about') : $data_audioBook->about ); 
			$data_audioBook->duration_seconds 	= ( Input::get('duration_seconds') ? Input::get('duration_seconds') : $data_audioBook->duration_seconds ); 
			$data_audioBook->copyright_year 	= ( Input::get('copyright_year') ? Input::get('copyright_year') : $data_audioBook->copyright_year ); 
			$data_audioBook->visibility 		= ( Input::get('visibility') ? Input::get('visibility') : $data_audioBook->visibility ); 
			$data_audioBook->released_at 		= ( Input::get('released_at') ? Input::get('released_at') : $data_audioBook->released_at ); 
			$data_audioBook->category_id 		= ( Input::get('category_id') ? Input::get('category_id') : $data_audioBook->category_id ); 
			$data_audioBook->publisher_id 		= ( Input::get('publisher_id') ? Input::get('publisher_id') : $data_audioBook->publisher_id ); 
			$data_audioBook->updated_at 		=  date('Y-m-d H:i:s');
			$data_audioBook->save();
			if(isset($data_audioBook)){
				if(Input::file('audio_file_url'))
				{
					$audiobooks = 'audiobook';
					$files = Input::file('audio_file_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path = $this->general->url_api_path().$audiobooks.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$data_audioBook->audio_file_url = $filename;
						$data_audioBook->save();				
					}			
				}
				if(Input::file('audio_preview_file_url'))
				{
					$audiobooks = 'audiobook';
					$files = Input::file('audio_preview_file_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->url_api_path().$audiobooks.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$data_audioBook->audio_preview_file_url = $filename;
						$data_audioBook->save();				
					}			
				}
				if(Input::file('cover_picture_url'))
				{
					$audiobooks = 'audiobook';
					$files = Input::file('cover_picture_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->url_api_path().$audiobooks.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$data_audioBook->cover_picture_url = $filename;
						$data_audioBook->save();				
					}			
				}
				if(Input::file('banner_picture_url'))
				{
					$audiobooks = 'audiobook';
					$files = Input::file('banner_picture_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->url_api_path().$audiobooks.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$data_audioBook->banner_picture_url = $filename;
						$data_audioBook->save();				
					}			
				}			
				$result = ResponseUtil::json($data_audioBook,'berhasil','success');						
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
     * PUT /audiobooks/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        // TODO: Check Admin Only

        $data = AudioBook::find($id);
        if ($data == null) return ResponseUtil::json('', 'Audiobook not found', 'not_found', 404);
        $data->fill(request()->json()->all());
        $data->save();
        return ResponseUtil::json($data);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /audiobooks/{id}
     *
     * @param  int $id
     * @return Response
    */

	public function delete($id)
    {
        $audiobook = AudioBook::find($id);
		if(isset($audiobook)){
			$audiobook->delete();
			//restore();
			$result = ResponseUtil::json($audiobook,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	
    public function destroy($id)
    {
        // TODO: Check Admin Only
        $data = AudioBook::find($id);
        if ($data == null) return ResponseUtil::json('', 'Audiobook not found', 'not_found', 404);
        $data->delete();
        return ResponseUtil::json('', 'Audiobook deleted', '', 200);
    }
	

}