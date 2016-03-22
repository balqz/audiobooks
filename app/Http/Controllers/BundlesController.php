<?php namespace App\Http\Controllers;

use App\Bundle;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;

class BundlesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /bundles
     *
     * @return Response
     */
    public function index()
    {
        return ResponseUtil::json(ApiUtils::getList(Bundle::query()));
    }

    /**
     * Show the form for creating a new resource.
     * GET /bundles/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /bundles
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /bundles/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /bundles/{id}/edit
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
     * PUT /bundles/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return ResponseUtil::json(ApiUtils::get(Bundle::query(), $id));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /bundles/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}