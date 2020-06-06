<?php

namespace App\Exports;

use App\RelationshipConfiguration;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Tablet;
use App\Employee;

class TabletExportByEmployee implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        RelationshipConfiguration::whereHasMorph('assignable', [Tablet::class, Employee::class], function ($query) {
        $query->where('id', 'id');
        })->get();
    }
}
