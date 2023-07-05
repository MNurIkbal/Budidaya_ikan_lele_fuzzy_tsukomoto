<?php
require_once '../vendor/autoload.php';

use IFaqih\AIMethods\Fuzzy as IFFuzzy;

$r = IFFuzzy::method(FUZZY_METHOD_TSUKAMOTO)
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
    ->attribute("speed", [
        'slow'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
        'fast'     =>  FUZZY_MEMBERSHIP_LINEAR_UP
    ], [500, 1200])
    ->rules(
        // ['rules'  =>  ["many" => "little", "level" => "low"], 'result' => 'slow'],
        // ['rules'  =>  ["many" => "little", "level" => "high"], 'result' => 'fast'],
        // ['rules'  =>  ["many" => "much", "level" => "low"], 'result' => 'slow'],
        // ['rules'  =>  ["many" => "much", "level" => "high"], 'result' => 'fast']
        ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Kecil", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Sedikit", "jumlah_pakan" => "Sedikit"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Banyak"], 'result' => 'Rendah'],
        ['rules'  =>  ["luas_kolam" => "Besar", "jumlah_bibit" => "Banyak", "jumlah_pakan" => "Sedikit"], 'result' => 'Tinggi']
    )
    ->set_values([
        'luas_kolam' =>  50,
        'jumlah_bibit' =>  58,
        'jumlah_pakan'  =>  100,
    ])
    ->execute(FUZZY_EXEC_AS_ARRAY);
var_dump($r['attributes']);
var_dump($r);
