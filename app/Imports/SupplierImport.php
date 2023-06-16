<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Supplier([
            'Name'     => $row['ten'],
            'Address'  => $row['dia_chi'],
            'Numbers'  => $row['so_dien_thoai'],
            'image'    => '',
            'created_at' => '',
            'update_at' => ''
        ]);
    }
}
