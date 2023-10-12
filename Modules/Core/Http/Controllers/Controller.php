<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Nwidart\Modules\Facades\Module;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $moduleDisabled = array_keys(Module::allDisabled());
        View::share([
            'moduleDisabled' => $moduleDisabled,
        ]);
    }
}
