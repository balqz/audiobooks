<?php namespace App\Http\Controllers;

use App\AudioBookChapter;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;

class AudioBookChaptersController extends Controller
{

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

    /**
     * Show the form for creating a new resource.
     * GET /audiobookchapters/create
     *
     * @return Response
     */
    public function create()
    {
        //
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
        return ResponseUtil::json(ApiUtils::get(AudioBookChapter::query(), $id));
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
        //
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