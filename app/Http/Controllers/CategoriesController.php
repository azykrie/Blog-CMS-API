<?php
namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json([
            'categories' => categories::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $category = categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'data'    => $category,
        ], 201);
    }

    public function show($id)
    {
        $category = categories::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }

        return response()->json([
            'category' => $category,
        ]);
    }

    public function update($id , Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $category = categories::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'message' => 'Category updated successfully',
            'data'    => $category,
        ]);
    }

    public function destroy($id)
    {
        $category = categories::find($id);

        if (! $category) {
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
