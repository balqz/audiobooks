<?php namespace App\Http\Controllers;

use App\Libraries\General;
use App\Purchase;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;
use App\AudioBook;
use App\Category;
use App\User;
use App\AudioBookChapter;

class PurchasesController extends Controller
{
	public function __construct(){
        $this->general = New General;
    }
    /**
     * Display a listing of the resource.
     * GET /purchases
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Purchase::query()));
    }

    /**
     * Show the form for creating a new resource.
     * GET /purchases/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /purchases
     *
     * @return Response
     */
    public function store()
    {
        //
    }
	
	public function viewall()
    {	
        $purchase = ApiUtils::getList(Purchase::query())->ToArray();
		$arr_val = array();
		foreach($purchase as $val){
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
			$data_audiobookChapter_id = AudioBookChapter::findorFail($val['audiobookChapter_id']);				
			$data_user = User::findorFail($val['user_id']);				
			$arr_val[] = array('id'=>$val['id'],
								 'price'=>$val['price'],	
								 'audiobook_id'=>$arr_val_audiobook,	
								 'audiobookChapter_id'=>$data_audiobookChapter_id,	
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
     * GET /purchases/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //return ResponseUtil::json(ApiUtils::get(Purchase::query(), $id));
		$data_purchase = ApiUtils::get(Purchase::query(), $id)->ToArray();
		if(!isset($data_purchase)){
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}else{
			$data_audioBook = AudioBook::findorFail($data_purchase['audiobook_id'])->ToArray();
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
			$data_audiobookChapter_id = AudioBookChapter::findorFail($data_purchase['audiobookChapter_id']);				
			$data_user = User::findorFail($data_purchase['user_id']);				
			$arr_val[] = array('id'=>$data_purchase['id'],
								 'price'=>$data_purchase['price'],	
								 'audiobook_id'=>$arr_val_audiobook,	
								 'audiobookChapter_id'=>$data_audiobookChapter_id,	
								 'user_id'=>$data_user,	
								 'updated_at'=>$data_purchase['updated_at'],	
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
     * GET /purchases/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /purchases/{id}
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
        $purchase = Purchase::find($id);
		if(isset($purchase)){
			$purchase->delete();
			//restore();
			$result = ResponseUtil::json($purchase,'berhasil','success');
			
		}else{
			$result = ResponseUtil::json('','tidak ada data','failed',201);
		}
        return $result;
    }
	
    /**
     * Remove the specified resource from storage.
     * DELETE /purchases/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}