<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Admin\PermissionRequest;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view permissions|create permissions|update permissions|delete permissions', ['only' => ['index', 'store']]);
        $this->middleware('permission:create permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:update permissions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete permissions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of permissions.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created permission in database.
     *
     * @param  \App\Http\Requests\Admin\PermissionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        try {
            $request->handle();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission created successfully');
        } catch (\Throwable $th) {
            Log::error('Permission creation failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $request->handle($permission);
            return redirect()->route('permissions.index')
                ->with('success', 'Permission updated successfully');
        } catch (\Throwable $th) {
            Log::error('Permission update failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Permission deletion failed: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
