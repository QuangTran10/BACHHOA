<?php

namespace App\Imports;

use App\Models\ReceiptDetails;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Import implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // return new ReceiptDetails([
        //     ''
        // ]);

        // $data = array();
        // foreach ($rows as $row) 
        // {
        //    $data[] = array(
        //     'product_id' => $row[0],
        //    );
        // }

        // return $data;

    }
}
