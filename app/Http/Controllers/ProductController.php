<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display all Product
    public function Show()
    {
        $data = Product::with('subcategory','subcategory.category')->get();
        return view('products.main', compact('data'));
        // return response()->json([
        //     'message' => 'Product fetch successfully',
        //     'data' => $data
        // ],201);
    }



    // Create form Products
    public function Create()
    {
        $subcategory = Subcategory::all();
        return view('products.add', compact('subcategory'));
    }



    // Insert new Product
    public function Insert(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name'           => 'required|unique:products,name',
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'old_price'      => 'nullable|numeric|min:0',
            'new_price'      => 'required|numeric|min:0',
        ]);

        $image = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageName = $request->name . '.' .$request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->storeAs('products', $imageName);
        }

        $data = Product::create([
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'description' => $request->description,
            'old_price' => $request->old_price,
            'new_price' => $request->new_price,
            'image' => $image,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('product.show')
                         ->with('success', 'Product inserted successfully.');

        // return response()->json([
        //     'message' => 'Product inserted successfully',
        //     'data' => $data
        // ],201);
    }



    // Edit single Product
    public function Edit($id)
    {
        $subcategory = Subcategory::all();
        $data = Product::findOrFail($id);
        return view('products.edit', compact('data','subcategory'));
        
        // return response()->json([
        //     'message' => 'Product get successfully',
        //     'data' => $data
        // ]);
    }



    // Update Product
    public function Update(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name'           => 'required|unique:products,name,'. $data->id,
            'description'    => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'old_price'      => 'nullable|numeric|min:0',
            'new_price'      => 'required|numeric|min:0',
        ]);

        $image = $data->image;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if($image){
                Storage::disk('public')->delete($image);
            }
            $imageName = $request->name . '.' .$request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->storeAs('products', $imageName);
        }

        $data->update([
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'description' => $request->description,
            'old_price' => $request->old_price,
            'new_price' => $request->new_price,
            'image' => $image,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('product.show')
                         ->with('success', 'Product updated successfully.');

        // return response()->json([
        //     'message' => 'Product updated successfully',
        //     'data' => $data
        // ]);
    }



    // Delete Product
    public function Delete($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return redirect()->route('product.show')
                         ->with('success', 'Product deleted successfully.');
        // return response()->json([
        //     'message' => 'Product deleted successfully'
        // ]);
    }
}
