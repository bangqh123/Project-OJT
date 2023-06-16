<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection()
    {
        return Product::all();
    }
    
    public function model(array $row)
    {
        // dd($row);
        return new Product([
            'Name'     => $row['ten_san_pham'],
            'Desc'     => $row['mo_ta'],
            'Quantity' => $row['so_luong'],
            'Unit'    => $row['don_vi_san_pham'],
            'Price'    => $row['gia_san_pham'],
            'image'    => '',
            'created_at'    => '',
            'update_at'    => '',
            'Category_id'    => 1,
            'Supplier_id'    => 3,
        ]);
    }
}
