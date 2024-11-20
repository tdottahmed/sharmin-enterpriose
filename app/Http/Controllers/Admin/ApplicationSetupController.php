<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationSetupController extends Controller
{
    public function __construct()
    {
        $permissions = [
            'setup application' => ['organization', 'storeOrganization'],
            // 'create permission' => ['create', 'store'],
            // 'update permission' => ['edit', 'update'],
            // 'delete permission' => ['destroy'],
        ];

        foreach ($permissions as $permission => $actions) {
            $this->middleware("permission:{$permission}", ['only' => $actions]);
        }
    }
}
