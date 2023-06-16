<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(5);

        return view('category.index',compact('category'),['title' => 'Category Index'])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create',['title' => 'Category Create Page']);
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
        ]);

        $input = $request->all();

        Category::create($input);

        return redirect()->route('category.index')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',compact('category'),['title' => 'Show Page']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'),['title' => 'Category Edit Page']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'Name' => 'required',
            'Desc' => 'required'
        ]);

        $input = $request->all();

        $category->update($input);

        return redirect()->route('category.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
                        ->with('success','Category deleted successfully');
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Category::whereIn('id', $ids)->delete();
        return redirect()->route('category.index')
                        ->with('success','Selected Category deleted successfully');
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
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new CategoryImport,request()->file('file'));

        return back();
    }

    // public function search()
    // {
    //     $search_text = $_GET['query'];
    //     $category = Category::where('Name','LIKE','%'.$search_text.'%')->get();

    //     return view('category.search', compact('category'),['title' => 'Search Result']);
    // }
}
