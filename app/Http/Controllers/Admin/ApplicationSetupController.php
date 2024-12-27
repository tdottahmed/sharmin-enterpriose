<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationSetup;
use Illuminate\Http\Request;

class ApplicationSetupController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view applicationSettings')->only('index');
    //     $this->middleware('permission:create applicationSettings')->only('update');
    // }

    public function index()
    {
        $applicationSetup = ApplicationSetup::get();
        return view('admin.application-setup.index', compact('applicationSetup'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', 'app_logo', 'app_favicon');
        try {
            foreach ($data as $type => $value) {
                ApplicationSetup::updateOrCreate(['type' => $type], ['value' => $value]);
            }
            if ($request->file('app_logo') || $request->file('app_favicon')) {
                if ($request->file('app_logo')) {
                    $imagePath = filepondUpload($request->file('app_logo'), 'organization');
                    ApplicationSetup::updateOrCreate(['type' => 'app_logo'], ['value' => $imagePath]);
                }
                if ($request->file('app_favicon')) {
                    $imagePath = filepondUpload($request->file('app_favicon'), 'organization');
                    ApplicationSetup::updateOrCreate(['type' => 'app_favicon'], ['value' => $imagePath]);
                }
            }
            return redirect()->route('applicationSetup.index')->with('success', 'Organization Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
