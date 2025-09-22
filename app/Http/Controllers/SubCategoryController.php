<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    // Display all Subcategory
    public function Show()
    {
        $data = Subcategory::with('category')->get();
        return view('subcategory.main', compact('data'));
        // return response()->json([
        //     'message' => 'Subcategory fetch successfully',
        //     'data' => $data
        // ],201);
    }



    // Create form Categories
    public function Create()
    {
        $categories = Category::all();
        return view('subcategory.add', compact('categories'));
    }



    // Insert new Subcategory
    public function Insert(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name',
        ]);

        $data = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('subcategory.show')
                         ->with('success', 'Category inserted successfully.');
        // return response()->json([
        //     'message' => 'Subcategory inserted successfully',
        //     'data' => $data
        // ],201);
    }



    // Edit single Subcategory
    public function Edit($id)
    {
        $categories = Category::all();
        $data = Subcategory::findOrFail($id);
        return view('subcategory.edit', compact('data','categories'));

        // return response()->json([
        //     'message' => 'Subcategory get successfully',
        //     'data' => $data
        // ]);
    }



    // Update Subcategory
    public function Update(Request $request, $id)
    {
        $data = Subcategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name,' . $data->id,
        ]);

        $data->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('subcategory.show')
                         ->with('success', 'Category updated successfully.');
        // return response()->json([
        //     'message' => 'Subcategory updated successfully',
        //     'data' => $data
        // ]);
    }



    // Delete Subcategory
    public function Delete($id)
    {
        $data = Subcategory::findOrFail($id);
        $data->delete();

        return redirect()->route('subcategory.show')
                         ->with('success', 'Category deleted successfully.');
        // return response()->json([
        //     'message' => 'Subcategory deleted successfully'
        // ]);
    }
    
}
