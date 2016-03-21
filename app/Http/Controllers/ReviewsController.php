<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Review;
use App\Utils\AuthUtils;

class ReviewsController extends Controller
{
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

    /**
     * Display the specified resource.
     * GET /reviews/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return ResponseUtil::json(ApiUtils::get(Review::query(), $id));
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
