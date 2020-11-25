<?php

namespace App\Exports;

use App\RelationshipConfiguration;
use Maatwebsite\Excel\Concerns\FromCollection;

class ComputersAllExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $computers = RelationshipConfiguration::with(['assignable', 'employee'])
            ->join('computers', 'relationship_configurations.assignable_id', '=', 'computers.id')
            ->join('employees', 'relationship_configurations.employee_id', '=', 'employees.id')
            ->where('relationship_configurations.assignable_type', '=', 'App\Computer')
            ->get();

        $tablets = RelationshipConfiguration::with(['assignable', 'employee'])
            ->join('tablets', 'relationship_configurations.assignable_id', '=', 'tablets.id')
            ->join('employees', 'relationship_configurations.employee_id', '=', 'employees.id')
            ->where('relationship_configurations.assignable_type', '=', 'App\Tablet')
            ->get();

        return $computers;
    }
}
