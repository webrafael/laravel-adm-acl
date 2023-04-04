<?php

namespace App\Http\Middleware;

use App\AclControl\AclControlFacade;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AclAuthorization
{
    use AuthorizesRequests;

    private mixed $httpAction = [];
    private array $getActionName = [];
    private array $action = [
        'index' => 'read',
        'create' => 'create',
        'store' => 'create',
        'show' => 'read',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->httpAction     = $request->route()->getAction();
        $this->getActionName = $this->getAction();

        if (! $this->checkActionExists()){
            return $next($request);
        }

        $makeAction = $this->makeActionName();

        $this->authorize($makeAction);

        AclControlFacade::setAclControl(auth()->user());

        return $next($request);
    }

    private function checkActionExists(): bool
    {
        if (!count($this->getActionName) || !isset($this->getActionName[0]) || !isset($this->getActionName[1])) {
            return false;
        }
        return true;
    }

    private function getAction(): array
    {
        return isset($this->httpAction['as']) ? explode('.', $this->httpAction['as']) : [];
    }

    private function makeActionName(): string
    {
        return "{$this->getActionName[0]}-{$this->action[$this->getActionName[1]]}";
    }
}
