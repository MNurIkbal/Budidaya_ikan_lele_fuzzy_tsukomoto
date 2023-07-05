<?php
require_once '../vendor/autoload.php';

use IFaqih\AIMethods\Fuzzy as IFFuzzy;

function fuzzy($luas_kolam, $jumlah_bibit, $jumlah_pakan)
{
    $fuzzy = IFFuzzy::method(FUZZY_METHOD_TSUKAMOTO)
        ->attribute("luas_kolam", [
            'Kecil'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [65, 85]
            ],
            'Besar'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [85, 112]
            ]
        ])
        ->attribute("jumlah_bibit", [
            'Sedikit'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [10000, 17000]
            ],
            'Banyak'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [17000, 23000]
            ]
        ])
        ->attribute("jumlah_pakan", [
            'Sedikit'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [30, 50]
            ],
            'Banyak'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [50, 69]
            ]
        ])
        ->attribute("result", [
            'Rendah'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
                'domain'        =>  [810, 975]
            ],
            'Tinggi'    =>  [
                'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
                'domain'        =>  [975, 2070]
            ]
        ])
        ->rules(
            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],

            ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],

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
