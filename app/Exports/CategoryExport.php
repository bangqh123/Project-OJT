<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CategoryExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all();
    }

    public function headings() :array {
    	return ["Loại sản phẩm", "Mô tả"];
    }

    public function map($Category): array 
    { 
        return [ $Category->Name, $Category->Desc ]; 
    }
}
