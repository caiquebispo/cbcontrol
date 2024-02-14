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

        if ($row[0] != 'NOME') {

            if (!$company->clients()->where('full_name', strtoupper($row[0]))->first()) {

                $company->clients()
                    ->create([

                        'full_name' => strtoupper($row[0]),
                        'group_id' => 10,

                    ])->address()->create([

                        'states' => 'BA',
                        'zipe_code' => 45500000,
                        'city' => 'Ibirapitanga',
                        'neighborhood' => $row[1] != "" ? $row[1] : 'N/D',
                        'road' => $row[2] != "" ? $row[2] : 'N/D',

                    ]);
            }
        }
    }
}
