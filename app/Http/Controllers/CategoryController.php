<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Display all Categories
    public function Show()
    {
        $data = Category::all();
        return view('category.main', compact('data'));
        // return response()->json([
        //     'message' => 'Category fetch successfully',
        //     'data' => $data
        // ],201);
    }
    
    
    
    // Create form Categories
    public function Create()
    {
        return view('category.add');
    }



    // Insert new Category
    public function Insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $data = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('category.show')
                         ->with('success', 'Category inserted successfully.');

        // return response()->json([
        //     'message' => 'Category inserted successfully',
        //     'data' => $data
        // ],201);
    }



    // Edit single Category
    public function Edit($id)
    {
        $data = Category::findOrFail($id);

        return view('category.edit', compact('data'));

        // return response()->json([
        //     'message' => 'Category get successfully',
        //     'data' => $data
        // ]);
    }



    // Update Category
    public function Update(Request $request, $id)
    {
        $data = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $data->id,
        ]);

        $data->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('category.show')
                         ->with('success', 'Category updated successfully.');

        // return response()->json([
        //     'message' => 'Category updated successfully',
        //     'data' => $data
        // ]);
    }



    // Delete Category
    public function Delete($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->route('category.show')
                         ->with('success', 'Category deleted successfully.');

        // return response()->json([
        //     'message' => 'Category deleted successfully'
        // ]);
    }
}
