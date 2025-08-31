<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller responsável pelo gerenciamento de usuários
 */
class UserController extends Permissions
{
    /**
     * Lista usuarios com paginacao
     *
     * @return AnonymousResourceCollection Colecao de usuarios
     */
    public function index(): AnonymousResourceCollection
    {
        $this->checkPermission('list_users');

        $users = User::paginate(10);

        return UserResource::collection($users);
    }

    /**
     * Cria um novo user
     *
     * @param StoreUserRequest $request Request com dados do usuário
     * @return Response http 201
     */
    public function store(StoreUserRequest $request):Response
    {
        $this->checkPermission('create_users');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->type);

        return response()->noContent(201);
    }

    /**
     * Mostra dados de um usuario por id
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        $user->id == Auth::user()->id
            ? $this->checkAnyPermission(['get_personal_data', 'list_users'])
            : $this->checkPermission('list_users');

        return new UserResource($user);
    }

    /**
     * Atualiza os dados de um usuário
     *
     * @param Request $request Request com os dados a atualizar
     * @param User $user Usuário a ser atualizado
     * @return JsonResponse Retorna status HTTP 200 OK com os dados atualizados
     */
    public function update(Request $request, User $user)
    {
        $this->checkPermission('update_users');

        $data = $request->only(['name', 'email']);

        $user->update($data);

        return response()->noContent(200);
    }

    /**
     * Remove um usuario
     *
     * @param User $user Usaurio que sera removido
     *
     * @return Response Retorna status http 204 
     */
    public function destroy(User $user)
    {
        $this->checkPermission('remove_users');

        $user->delete();

        return response()->noContent();
    }
}
