<?php

namespace App\Exports;

use App\Computer;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\RelationshipConfiguration;
use DB;

class ComputersAllExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $a = RelationshipConfiguration::with(['assignable', 'employee'])
        ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
        ->join('employees', 'relationship_configurations.employee_id', '=', 'employees.id')

        ->where('relationship_configurations.assignable_type', '=', 'App\Computer')

        ->get();
        return $a;
    }
}
