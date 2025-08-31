<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * Abstract controller pra gerenciar permissoes de todos os controllers
 * 
 * @internal Permissions por Addapter pattern, porem no futuro e se a API crescer eu
 *           poderia adiccionar extends BaseController dependendo do que fosse requisitado
 *           ... ou baseController extends Permissions... em fim, mudar a estrutura dependendo 
 *           do que fosse requisitado
 */
abstract class Permissions
{
    /**
     * Verifica se o usuario tem uma permissao em expecifico
     */
    protected function checkPermission($permission)
    {
        if (!$this->hasAnyPermission([$permission])) {
            abort(403, 'You do not have permission');
        }
    }

    /**
     * Verifica se o usuario uma das opcoes requisitadas
     */
    protected function checkAnyPermission(array $permissions){
        if (!$this->hasAnyPermission($permissions)) {
            abort(403, 'You do not have permission');
        }
    }
    
    private function hasAnyPermission(array|string $permissions): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        $permissions = is_array($permissions) ? $permissions : [$permissions];

        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return true;
            }
        }

        return false;
    }
}
