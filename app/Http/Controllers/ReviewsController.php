<?php

namespace App\Http\Controllers;

use App\Libraries\General;
use App\Http\Requests;
use App\Review;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use App\Utils\AuthUtils;
use App\AudioBook;
use App\Category;
use App\User;
use App\AudioBookChapter;
use Illuminate\Routing\Controller;

class ReviewsController extends Controller
{
	public function __construct(){
        $this->general = New General;
    }
    /**
     * Display a listing of the resource.
     * GET /reviews
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Review::query()));
    }

    /**
     * Store a newly created resource in storage.
     * POST /reviews
     *
     * @return Response
     */
    public function store()
    {
        $me = AuthUtils::authenticate();
        if ($me == NULL) return ResponseUtil::json(
            '',
            'You are unauthorized to access this',
            'unauthorized',
            403
        );
        $data = new Review();
        $data->fill(request()->json()->all());
        $data->user()->save($me);
        $data->save();
        return ResponseUtil::json($data);
    }

	public function viewall()
    {	
        $review = ApiUtils::getList(Review::query())->ToArray();
		$arr_val = array();
		foreach($review as $val){
			$data_audioBook = AudioBook::findorFail($val['audiobook_id'])->ToArray();
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
			$arr_val_audiobook[] = array('id'=>$data_audioBook['id'],
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
								 //'category_id'=>$val_categories,	
								  'updated_at'=>$data_audioBook['updated_at'],	
								); 			
			$data_user = User::findorFail($val['user_id']);				
			$arr_val[] = array('id'=>$val['id'],
								 'content'=>$val['content'],	
								 'rating'=>$val['rating'],	
								 'audiobook_id'=>$arr_val_audiobook,	
								  'user_id'=>$data_user,	
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
     * GET /reviews/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
		//return ResponseUtil::json(ApiUtils::get(Review::query(), $id));
		$data_review = ApiUtils::get(Review::query(), $id)->ToArray();
		if(!isset($data_review)){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}else{
			$data_audioBook = AudioBook::findorFail($data_review['audiobook_id'])->ToArray();
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
			$arr_val_audiobook[] = array('id'=>$data_audioBook['id'],
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
								 //'category_id'=>$val_categories,	
								  'updated_at'=>$data_audioBook['updated_at'],	
								); 			
							
			$data_user = User::findorFail($data_review['user_id']);				
			$arr_val[] = array('id'=>$data_review['id'],
								 'content'=>$data_review['content'],	
								 'rating'=>$data_review['rating'],	
								 'audiobook_id'=>$arr_val_audiobook,	
								  'user_id'=>$data_user,	
								 'updated_at'=>$data_review['updated_at'],	
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
     * Update the specified resource in storage.
     * PUT /reviews/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $data = Review::find($id);
        if ($data == null) return ResponseUtil::json('', 'Review not found', 'not_found', 404);
        $data->fill(request()->json()->all());
        $data->save();
        return ResponseUtil::json($data);
    }
	
	public function delete($id)
    {
        $review = Review::find($id);
		if(isset($review)){
			$review->delete();
			//restore();
			$result = ResponseUtil::json($review,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	
    /**
     * Remove the specified resource from storage.
     * DELETE /audiobooks/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (AuthUtils::authenticate() == NULL) return ResponseUtil::json(
            '',
            'You are unauthorized to access this',
            'unauthorized',
            403
        );

        $data = Review::find($id);
        if ($data == null) return ResponseUtil::json('', 'Audiobook not found', 'not_found', 404);
        $data->delete();
        return ResponseUtil::json('', 'Audiobook deleted', '', 200);
    }
}
