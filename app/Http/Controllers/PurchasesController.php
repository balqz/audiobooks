<?php namespace App\Http\Controllers;

use App\Purchase;
use App\Utils\ApiUtils;
use App\Utils\ResponseUtil;
use Illuminate\Routing\Controller;

class PurchasesController extends Controller
{

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

    /**
     * Display the specified resource.
     * GET /purchases/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return ResponseUtil::json(ApiUtils::get(Purchase::query(), $id));
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