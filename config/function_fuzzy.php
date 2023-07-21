<?php
require_once '../vendor/autoload.php';

use IFaqih\AIMethods\Fuzzy as IFFuzzy;

function fuzzy($luas_kolam, $jumlah_bibit, $jumlah_pakan)
{
    $fuzzy = IFFuzzy::method(FUZZY_METHOD_TSUKAMOTO)
        ->attribute("luas_kolam", [
            'Kecil'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [1, 65]
            ],
            'Besar'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [66, 112]
            ]
        ])
        ->attribute("jumlah_bibit", [
            'Sedikit'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [1, 10000]
            ],
            'Banyak'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [10001, 23000]
            ]
        ])
        ->attribute("jumlah_pakan", [
            'Sedikit'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [1, 30]
            ],
            'Banyak'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [31, 69]
            ]
        ])
        ->attribute("result", [
            'Rendah'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [1, 810]
            ],
            'Tinggi'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [811, 2070]
            ]
        ])
        ->rules(
            // R1
            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],

            // R2
            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            // R3
            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Banyak"], 'result' => 'Tinggi'],

            // R4
            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            // R5
            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            // R6
            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Tinggi'],

            // R7
            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            // R6
            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Banyak"], 'result' => 'Tinggi']
        )
        ->set_values([
            'luas_kolam' =>  $luas_kolam,
            'jumlah_bibit' =>  $jumlah_bibit,
            'jumlah_pakan'  =>  $jumlah_pakan,
        ])
        ->execute(FUZZY_EXEC_AS_ARRAY);

    return $fuzzy;
}

