<?php

// app/Exports/PermissionExport.php

namespace App\Exports;

use App\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Select only the columns you need (exclude `created_at` and `updated_at`)
        return ModelsPermission::select('id', 'name', 'group_name')->get();
    }

    public function headings(): array
    {
        // Define the headings for the CSV file
        return [];
    }
}
