<?php

namespace App\Http\Middleware;

use App\Constants\AccountTypePrefixConstants;
use Closure;
use Illuminate\Http\Request;

class CheckUserAccountType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se está logado, se não tiver redireciona
        if ( !auth()->check() )
            return redirect()->route('login');

        /*
        * Verifica se o usuário tem permissão de acessar determinada rota
        */

        // Recupera o tipo de conta do usuário logado
        $accountTypesConstants = AccountTypePrefixConstants::getConstants();
        $accountType = $accountTypesConstants[auth()->user()->account_type];
    
        // Recupera o prefixo da rota acessada
        $dataPrefix = explode('/',$request->route()->uri());
        $routePrefix = $dataPrefix[0];

        // Verifica se o tipo de conta bate com a rota acessada, caso não se redireciona para uma página 404
        if ( $routePrefix != $accountType )
            return abort(404);
    
    
        // Permite que continue (Caso não entre em nenhum dos if acima)...
        return $next($request);
    }
}
