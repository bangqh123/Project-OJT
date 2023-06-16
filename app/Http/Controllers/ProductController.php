<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->with('category', 'supplier')->paginate(5);

        return view('products.index',compact('products'),['title' => 'Product Index'])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('category', 'suppliers'),['title' => 'Create New Product']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Desc' => 'required',
            'Quantity' => 'required',
            'Unit' => 'required',
            'Price' => 'required',
            'Category_id' => 'required| integer',
            'Supplier_id' => 'required | integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'asset/image/products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Product::create($input);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'),['title' => 'Product Info Page']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit',compact('product', 'category', 'suppliers'),['title' => 'Update Product Page']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Name' => 'required',
            'Desc' => 'required',
            'Quantity' => 'required',
            'Unit' => 'required',
            'Price' => 'required',
            'Category_id' => 'required| integer',
            'Supplier_id' => 'required | integer'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'asset/image/products/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id', $ids)->delete();
        return redirect()->route('products.index')
                        ->with('success','Selected Product deleted successfully');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new ProductImport,request()->file('file'));

        return back();
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $products = Product::where('Name','LIKE','%'.$search_text.'%')->get();

        return view('products.search', compact('products'),['title' => 'Search Result']);
    }
}
