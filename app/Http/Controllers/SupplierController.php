<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\SupplierExport;
use App\Imports\SupplierImport;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::latest()->paginate(5);

        return view('supplier.index',compact('supplier'),['title' => 'Supplier Index'])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create',['title' => 'New Supplier']);
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
            'Address' => 'required',
            'Numbers' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'asset/image/suppliers/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Supplier::create($input);

        return redirect()->route('supplier.index')
                        ->with('success','Supplier added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show',compact('supplier'),['title' => 'Supplier Info Page']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit',compact('supplier'),['title' => ' Supplier Info Update Page']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'Name' => 'required',
            'Address' => 'required',
            'Numbers' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'asset/image/suppliers/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $supplier->update($input);

        return redirect()->route('supplier.index')
                        ->with('success','Supplier info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')
                        ->with('success','Supplier info removed successfully');
    }

    public function deleteChecked(Request $request)
    {
        $ids = $request->ids;
        Supplier::whereIn('id', $ids)->delete();
        return redirect()->route('supplier.index')
                        ->with('success','Selected Supplier deleted successfully');
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
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new SupplierImport,request()->file('file'));

        return back();
    }

    // public function search()
    // {
    //     $search_text = $_GET['query'];
    //     $supplier = Supplier::where('Name','LIKE','%'.$search_text.'%')->get();

    //     return view('supplier.search', compact('supplier'),['title' => 'Search Result']);
    // }
}
