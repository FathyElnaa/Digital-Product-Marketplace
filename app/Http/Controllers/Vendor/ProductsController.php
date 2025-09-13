<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('vendor_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('vendor.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'file_path' => 'required|file|mimes:zip,rar,pdf|max:20480', // 20MB
            'thumbnail' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'boolean'
        ]);

        $data['status'] = 'pending';


        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('file_path')) {
            $filepath = $request->file('file_path');
            $filename = uniqid() . '_' . $filepath->getClientOriginalName();
            $url = Storage::disk('public')->putFileAs('products', $filepath, $filename);
            $data['file_path'] = $url;
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = uniqid() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailUrl = Storage::disk('public')->putFileAs('products/thumbnails', $thumbnail, $thumbnailName);
            $data['thumbnail'] = $thumbnailUrl;
        }

        $data['vendor_id'] = Auth::id();
        Product::create($data);

        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return redirect()->route('vendor.products.index')->with('error', 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('vendor.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return redirect()->route('vendor.products.index')->with('error', 'Unauthorized action.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'file_path' => 'nullable|file|mimes:zip,rar,pdf|max:20480', // 20MB
            'thumbnail' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('file_path')) {

            if($product->file_path){
                Storage::disk('public')->delete($product->file_path);
            }

            $filepath = $request->file('file_path');
            $filename = uniqid() . '_' . $filepath->getClientOriginalName();
            $url = Storage::disk('public')->putFileAs('products', $filepath, $filename);
            $data['file_path'] = $url;
        }

        if ($request->hasFile('thumbnail')) {

            if($product->thumbnail){
                Storage::disk('public')->delete(($product->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = uniqid() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailUrl = Storage::disk('public')->putFileAs('products/thumbnails', $thumbnail, $thumbnailName);
            $data['thumbnail'] = $thumbnailUrl;
        }

        $data['status'] = $product->status;

        $product->update($data);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->vendor_id !== Auth::id()) {
            return redirect()->route('vendor.products.index')->with('error', 'Unauthorized action.');
        }

        // Delete the product file and thumbnail if they exist
        if ($product->file_path && Storage::disk('public')->exists($product->file_path)) {
            Storage::disk('public')->delete($product->file_path);
        }
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }
}
