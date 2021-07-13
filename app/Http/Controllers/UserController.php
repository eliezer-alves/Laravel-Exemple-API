<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $idUser
     * @return \Illuminate\Http\Response
     */
    public function show($idUser)
    {
        return $this->service->findOrFail($idUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UserRequest $request
     * @param int $idUser
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $idUser)
    {
        return $this->service->update($request->all(), $idUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $idUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUser)
    {
        return $this->service->delete($idUser);
    }
}
