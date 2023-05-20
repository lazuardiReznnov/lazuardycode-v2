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
    public function model(array $row)
    {
        return new Product([
            'category_product_id' => $row['category'],
            'name' => $row['name'],
            'slug' => $row['slug'],
            'brand' => $row['brand'],
            'descriptions' => $row['descriptions'],
        ]);
    }
}
