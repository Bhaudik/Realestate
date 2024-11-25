<?php
// app/Imports/PermissionImport.php

namespace App\Imports;

use \Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{
    public function model(array $row)
    {
        return new Permission([
            'name' => $row[1],
            'group_name' => $row[2],
        ]);
    }
}
