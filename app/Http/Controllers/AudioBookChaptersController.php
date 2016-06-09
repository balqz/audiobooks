<?php namespace App\Http\Controllers;

use App\Libraries\General;
use App\AudioBook;
use App\AudioBookChapter;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Http\Requests;
use Input;
use File;
use Image;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request; 

class AudioBookChaptersController extends Controller
{
	public function __construct(){
        $this->general = New General;
    }
    /**
     * Display a listing of the resource.
     * GET /audiobookchapters
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(AudioBookChapter::query()));
    }
	
	public function viewall()
    {	
        $audiobookchapter = ApiUtils::getList(AudioBookChapter::query());
		$arr_val = array();
		foreach($audiobookchapter as $val){
			$audiobookchapters = 'audiobookchapters';
			$cover_picture_url = $val->cover_picture_url != NULL ? $this->general->url_api_path().$audiobookchapters.'/'.$val->cover_picture_url : '';
			$audio_file_url = $val->audio_file_url != NULL ? $this->general->url_api_path().$audiobookchapters.'/'.$val->audio_file_url : '';
			
			$data_audioBook = AudioBook::findorFail($val->audiobook_id)->ToArray();
			$audiobook = 'audiobook';
			$audio_file_url = $data_audioBook['audio_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_file_url'] : '';
			$audio_preview_file_url = $data_audioBook['audio_preview_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_preview_file_url'] : '';
			$cover_picture_url = $data_audioBook['cover_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['cover_picture_url'] : '';
			$banner_picture_url = $data_audioBook['banner_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['banner_picture_url'] : '';
			
			$arr_valaudiobook[] = array('id'=>$data_audioBook['id'],
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
								 'updated_at'=>$data_audioBook['updated_at'],	
								); 			
			
			$updated_at = $val->updated_at->toDateTimeString();
			$arr_val[] = array('id'=>$val->id,
								 'title'=>$val->title,	
								 'subtitle'=>$val->subtitle,	
								 'price'=>$val->price,	
								 'about'=>$val->about,	
								 'picture_url'=>$cover_picture_url,	
								 'audio_file_url'=>$audio_file_url,	
								 'duration_seconds'=>$val->duration_seconds,	
								 'audiobook_id'=>$arr_valaudiobook,	
								 'updated_at'=>$updated_at,	
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
     * Show the form for creating a new resource.
     * GET /audiobookchapters/create
     *
     * @return Response
     */
    public function create()
    {
        // store
		$audiobookchapter = new AudioBookChapter;
		$audiobookchapter->title      = Input::get('title');
		$audiobookchapter->subtitle 	= Input::get('subtitle');
		$audiobookchapter->price 		= Input::get('price');
		$audiobookchapter->about 		= Input::get('about');
		$audiobookchapter->duration_seconds = Input::get('duration_seconds');
		$audiobookchapter->audiobook_id 	  = Input::get('audiobook_id');
		$audiobookchapter->save();
		if(isset($audiobookchapter)){
			if(Input::file('cover_picture_url'))
			{
				$audiobookchapters = 'audiobookchapters';
				$files = Input::file('cover_picture_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->public_path().$audiobookchapters.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audiobookchapter->cover_picture_url = $filename;
					$audiobookchapter->save();				
				}			
			}		
			if(Input::file('audio_file_url'))
			{
				$audiobookchapters = 'audiobookchapters';
				$files = Input::file('audio_file_url');
				$ext   = $files->getClientOriginalExtension();
				$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
				$path =  $this->general->public_path().$audiobookchapters.'/';
				$moved = $files->move($path, $filename);
				if(isset($moved)){
					$audiobookchapter->audio_file_url = $filename;
					$audiobookchapter->save();				
				}			
			}					
			$result = ResponseUtil::json($audiobookchapter,'data tersimpan','success');
		}else{
			$result = ResponseUtil::json('','data tidak tersimpan','failed',201);
		}
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     * POST /audiobookchapters
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /audiobookchapters/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //return ResponseUtil::json(ApiUtils::get(AudioBookChapter::query(), $id));
		$data_audiobookchapter = ApiUtils::get(AudioBookChapter::query(), $id);
		if(!isset($data_audiobookchapter)){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}else{
			$audiobookchapters = 'audiobookchapters';
			$cover_picture_url = $data_audiobookchapter->cover_picture_url != NULL ? $this->general->url_api_path().$audiobookchapters.'/'.$data_audiobookchapter->cover_picture_url : '';
			$audio_file_url = $data_audiobookchapter->audio_file_url != NULL ? $this->general->url_api_path().$audiobookchapters.'/'.$data_audiobookchapter->audio_file_url : '';
			
			$data_audioBook = AudioBook::findorFail($data_audiobookchapter->audiobook_id)->ToArray();
			$audiobook = 'audiobook';
			$audio_file_url = $data_audioBook['audio_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_file_url'] : '';
			$audio_preview_file_url = $data_audioBook['audio_preview_file_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['audio_preview_file_url'] : '';
			$cover_picture_url = $data_audioBook['cover_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['cover_picture_url'] : '';
			$banner_picture_url = $data_audioBook['banner_picture_url'] != NULL ? $this->general->url_api_path().$audiobook.'/'.$data_audioBook['banner_picture_url'] : '';
			
			$arr_valaudiobook[] = array('id'=>$data_audioBook['id'],
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
								 'updated_at'=>$data_audioBook['updated_at'],	
								); 			
			$updated_at = $data_audiobookchapter->updated_at->toDateTimeString();
			$arr_val[] = array('id'=>$data_audiobookchapter->id,
								 'title'=>$data_audiobookchapter->title,	
								 'subtitle'=>$data_audiobookchapter->subtitle,	
								 'price'=>$data_audiobookchapter->price,	
								 'about'=>$data_audiobookchapter->about,	
								 'picture_url'=>$cover_picture_url,	
								 'audio_file_url'=>$audio_file_url,	
								 'duration_seconds'=>$data_audiobookchapter->duration_seconds,	
								 'audiobook_id'=>$arr_valaudiobook,	
								 'updated_at'=>$updated_at,	
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
     * GET /audiobookchapters/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $audiobookchapter = AudioBookChapter::find($id);
		if(isset($audiobookchapter)){
			$audiobookchapter->title 				= ( Input::get('title') ? Input::get('title') : $audiobookchapter->title ); 
			$audiobookchapter->subtitle 			= ( Input::get('subtitle') ? Input::get('subtitle') : $audiobookchapter->subtitle ); 
			$audiobookchapter->price 				= ( Input::get('price') ? Input::get('price') : $audiobookchapter->price ); 
			$audiobookchapter->about 				= ( Input::get('about') ? Input::get('about') : $audiobookchapter->about ); 
			$audiobookchapter->duration_seconds 		= ( Input::get('duration_seconds') ? Input::get('duration_seconds') : $audiobookchapter->duration_seconds ); 
			$audiobookchapter->audiobook_id 		= ( Input::get('audiobook_id') ? Input::get('audiobook_id') : $audiobookchapter->audiobook_id ); 
			$audiobookchapter->updated_at 			=  date('Y-m-d H:i:s');
			$audiobookchapter->save();
			if(isset($audiobookchapter)){
				if(Input::file('cover_picture_url'))
				{
					$audiobookchapters = 'audiobookchapters';
					$files = Input::file('cover_picture_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->public_path().$audiobookchapters.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$audiobookchapter->cover_picture_url = $filename;
						$audiobookchapter->save();				
					}			
				}		
				if(Input::file('audio_file_url'))
				{
					$audiobookchapters = 'audiobookchapters';
					$files = Input::file('audio_file_url');
					$ext   = $files->getClientOriginalExtension();
					$filename = date('YmdHis').rand(0000,99999).'.'.$ext;
					$path =  $this->general->public_path().$audiobookchapters.'/';
					$moved = $files->move($path, $filename);
					if(isset($moved)){
						$audiobookchapter->audio_file_url = $filename;
						$audiobookchapter->save();				
					}			
				}	
				$result = ResponseUtil::json($audiobookchapter,'berhasil','success');					
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
     * PUT /audiobookchapters/{id}
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
        $audiobookchapter = AudioBookChapter::find($id);
		if(isset($audiobookchapter)){
			$audiobookchapter->delete();
			//restore();
			$result = ResponseUtil::json($audiobookchapter,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
    /**
     * Remove the specified resource from storage.
     * DELETE /audiobookchapters/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}