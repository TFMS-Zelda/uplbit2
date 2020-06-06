<?php

namespace App\Exports;

use App\Tablet;
use Maatwebsite\Excel\Concerns\FromCollection;

class TabletExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tablet::all();
    }
}
