<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SupplierExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Supplier::all();
    }

    public function headings() :array {
    	return ["Tên", "Địa chỉ", "Số điện thoại"];
    }

    public function map($Supplier): array 
    { 
        return [ $Supplier->Name, $Supplier->Address, $Supplier->Numbers ]; 
    }
}
