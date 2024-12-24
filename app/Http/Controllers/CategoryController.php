<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $permissions = [
            'view category' => ['index'],
            'create category' => ['create', 'store'],
            'update category' => ['edit', 'update'],
            'delete category' => ['destroy'],
        ];

        foreach ($permissions as $permission => $actions) {
            $this->middleware("permission:{$permission}", ['only' => $actions]);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Category::all();
        return view('admin.categories.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $request->handle();
            return $this->redirectWithSuccess('Category created successfully');
        } catch (\Throwable $th) {
            Log::error('Category creation failed: ' . $th->getMessage());
            return $this->redirectWithError('Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $request->handle($category);
            return $this->redirectWithSuccess('Category updated successfully');
        } catch (\Throwable $th) {
            Log::error('Category update failed: ' . $th->getMessage());
            return $this->redirectWithError('Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return $this->redirectWithSuccess('Category deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Category deletion failed: ' . $th->getMessage());
            return $this->redirectWithError('Something went wrong. Please try again.');
        }
    }

    private function redirectWithSuccess($message)
    {
        return redirect()->route('categories.index')
            ->with('success', $message);
    }

    private function redirectWithError($message)
    {
        return back()->with('error', $message);
    }
}
