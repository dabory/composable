<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCustomQuerySize;

class Type1Import implements ToArray, WithCustomQuerySize
{
    public function Array(Array $tables)
    {
        return $tables;
    }

    public function querySize(): int
    {
        return 15000;
    }
}
