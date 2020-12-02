<?php

namespace App\Http\Controllers\Web;

use App\Constants\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class HomeController extends Controller
{
    protected $rolesViews = [
        Roles::EMPLOYEE => 'vote'
    ];

    public function home(Request $request)
    {
        $user = $request->user();

        $role = $user->roles()->first();

        if ($role === null) {
            throw new UnauthorizedException();
        }

        $view = $this->rolesViews[$role->name] ?? null;

        if ($view === null) {
            throw new UnauthorizedException();
        }

        return redirect()->route($view);
    }
}
