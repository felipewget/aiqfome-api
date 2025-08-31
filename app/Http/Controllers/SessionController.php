<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Controller responsavel por gerenciar sessoes e autenticação via JWT.
 */
class SessionController extends Permissions
{
    /**
     * Cria uma nova sessão
     *
     * @param StoreSessionRequest $request Request contendo email e senha
     * @throws \Exception Caso ocorra algum erro interno durante autenticação
     * @return JsonResponse Retorna o token JWT e os dados do usuário autenticado
     * @unauthenticated
     * @bodyParam email string required Email do usuário. Example: admin@aiqfome.com.br
     * @bodyParam password string required Senha do usuário. Example: Me_contrata_ai@123
     */
    public function store(StoreSessionRequest $request): mixed
    {
        if (!$token = JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => new UserResource(Auth::user())
        ]);
    }

    /**
     * Finaliza uma sessao JWT e adiciona o token a uma blacklist
     *
     * @return JsonResponse Retorna o token JWT e os dados do usuário autenticado
     */
    public function destroy(): Response
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->noContent();
    }
}
