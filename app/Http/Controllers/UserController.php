<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatedUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = $request->get('current_page') ?? 1;
        $regsPerPage = 3;
        $skip = ($currentPage - 1) * $regsPerPage;

        $users = User::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return response()->json(new UserCollection($users), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $data = ($request->validated());

        try {
            $user = new User();
            $user->fill($data);
            $user->password = Hash::make(2341);
            $user->save();

            return response()->json(new UserResource($user), 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'falha ao Criar usuário !!!',
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrfail($id);
            return response()->json(new UserResource($user), 200);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'falha ao buscar usuário !!!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedUserRequest $request, $id)
    {
        $data = ($request->validated());

        try {
            $user = User::findOrFail($id);
            $user->update($data);

            return response()->json(new UserResource($user), 200);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'falha no updated do usuário !!!',
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $removed = User::destroy($id);
            if (!$removed) {
                throw new Exception('');
            }

            return response()->json(null, 204);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'falha ao deletar o usuário !!!',
                'error' => $ex
            ], 400);
        }
    }
}
