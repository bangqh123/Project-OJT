<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Category([
            'Name'     => $row['loai_san_pham'],
            'Desc'     => $row['mo_ta'],
            'created_at' => '',
            'update_at' => ''
        ]);
    }
}
