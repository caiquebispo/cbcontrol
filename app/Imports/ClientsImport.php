<?php

namespace App\Imports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ClientsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        set_time_limit(0);
        $company = Auth::user()->company;
        if ($row[0] != 'Codigo_Clientes') {

            if (isset($row[1]) && !$company->clients()->where('full_name', strtoupper($row[1]))->first()) {

                $company->clients()
                    ->create([

                        'full_name' => strtoupper($row[1]),
                        'number_phone' => $row[18],
                        'value' => 0,
                        'local' => $row[11],
                        'delivery' => $row[15],
                        'payment_method' => strtoupper('NAO DEFINIDO'),
                        'group_id' => 2,

                    ]);
            }
        }
    }
}
