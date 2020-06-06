<?php

namespace App\Exports;

use App\Computer;
use Maatwebsite\Excel\Concerns\FromCollection;

class ComputersAllExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Computer::all();
    }
}
