<?php namespace App\Http\Controllers;

use App\User;
use App\Utils\ApiUtils;
use App\Utils\AuthUtils;
use App\Utils\ResponseUtil;
use Hash;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /users
     *
     * @return Response
     */
    public function index()
    {
        // TODO: Check Admin Only
        if (AuthUtils::authenticate() == NULL) return ResponseUtil::json(
            '',
            'You are unauthorized to access this',
            'unauthorized',
            403
        );
        return ResponseUtil::json(ApiUtils::getList(User::query()));
    }

    /**
     * Show the form for creating a new resource.
     * GET /users/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /users
     *
     * @return Response
     */
    public function store()
    {
        $data = new User();
        $data->fill(request()->json()->all());
        $data->password = Hash::make(request()->json()->all()['password']);
        $data->save();
        return ResponseUtil::json($data);
    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return ResponseUtil::json(ApiUtils::get(User::query(), $id));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /users/{id}/edit
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
     * PUT /users/{id}
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
     * DELETE /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}