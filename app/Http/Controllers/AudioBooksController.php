<?php namespace App\Http\Controllers;

use App\AudioBook;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;

class AudioBooksController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /audiobooks
     *
     * @return Response
     */
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
    public function show($id)
    {
        return ResponseUtil::json(ApiUtils::get(AudioBook::query(), $id));
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
    public function destroy($id)
    {
        // TODO: Check Admin Only
        $data = AudioBook::find($id);
        if ($data == null) return ResponseUtil::json('', 'Audiobook not found', 'not_found', 404);
        $data->delete();
        return ResponseUtil::json('', 'Audiobook deleted', '', 200);
    }

}