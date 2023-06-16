<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
        return Category::all();
    }

    public function headings() :array {
    	return ["Tên sản phẩm", "Mô tả", "Số lượng", "Đơn vị sản phẩm", "Giá sản phẩm", ];
    }

    public function map($Product): array 
    { 
        return [ $Product->Name, $Product->Desc, $Product->Quantity, $Product->Unit, $Product->Price,  ]; 
    }
}
