<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
     public function __construct()
    {
    $this->middleware('auth');
    $products = Product::orderBy('id', 'desc')->get();
    view()->share('products', $products);
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.product-list', compact('products'));    
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
        'idCategory' => 'required', // Bắt buộc phải chọn danh mục
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

        $product = new \App\Models\Product();
    
        $product->idCategory = $request->idCategory; 
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

    // --- XỬ LÝ ẢNH (QUAN TRỌNG) ---
        $imagePath = null;

    // Kiểm tra: Nếu người dùng có upload file từ máy
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $imagePath = $fileName; // Lưu tên file (ví dụ: 123_ao.jpg)
        } 
    // Nếu không upload file, thì kiểm tra xem có link URL không
        elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url; // Lưu nguyên đường link (https://...)
        }

        $product->image = $imagePath;
    // --------------------------------

        $product->save();
        return redirect()->route('admin.product.index'); 
    } 
    
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        view()->share('product', $product);
        view()->share('categories', $categories);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idCategory' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::find($id);
        $product->idCategory = $request->idCategory;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->status = $request->status;

    // Nếu có upload file mới
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $product->image = $fileName;
        } 
        // Nếu không up file, nhưng có nhập link ảnh mới
        elseif ($request->filled('image_url')) {
            $product->image = $request->image_url;
        }
        // Nếu không làm gì cả thì giữ nguyên ảnh cũ (không cần code gì thêm)

        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_sp', compact('product'));
    }

    public function showByCategory($categoryId, $id)
    {
        $category = Category::findOrFail($categoryId);

        $product = Product::where('id', $id)->where('idCategory', $categoryId)->first();
        if (! $product) {
            abort(404);
        }

        return view('product_sp', compact('product'));
    }
}