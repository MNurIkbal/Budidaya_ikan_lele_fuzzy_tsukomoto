<?php 
require_once '../vendor/autoload.php';

use IFaqih\AIMethods\Fuzzy as IFFuzzy;

$main = IFFuzzy::method(FUZZY_METHOD_TSUKAMOTO)
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
    ->rules(
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
        'jumlah_pakan'  =>  292
    ])
    ->execute();
var_dump($main);

//     // ganti program ini untuk variable luas kolam dengan himpunan kecil[65, 85] dan himpunan besar[85, 112],variable jumlah bibit dengan himpunan sedikit [10000, 17000] dan himpunan banyak[17000, 23000],variable jumlah pakan dengan himpunan sedikit[30, 50] dan himpunan banyak[30, 50].beserta rule nya diganti menjadi  Rule 1: IF luas kolam kecil AND jumlah bibit sedikit AND jumlah pakan sedikit THEN hasil predikat adalah rendah  Rule 2: IF luas kolam kecil AND jumlah bibit sedikit AND jumlah pakan banyak THEN hasil predikat adalah rendah  Rule 3: IF luas kolam kecil AND jumlah bibit banyak AND jumlah pakan sedikit THEN hasil predikat adalah rendah  Rule 4: IF luas kolam kecil AND jumlah bibit banyak AND jumlah pakan banyak THEN hasil predikat adalah rendah  Rule 5: IF luas kolam besar AND jumlah bibit sedikit AND jumlah pakan banyak THEN hasil predikat adalah rendah  Rule 6: IF luas kolam besar AND jumlah bibit sedikit AND jumlah pakan sedikit THEN hasil predikat adalah rendah  Rule 7: IF luas kolam besar AND jumlah bibit banyak AND jumlah pakan banyak THEN hasil predikat adalah rendah  Rule 8: IF luas kolam besar AND jumlah bibit banyak AND jumlah pakan sedikit THEN hasil predikat adalah tinggi

// $va = IFFuzzy::method(FUZZY_METHOD_TSUKAMOTO)
//     ->attributes(
//         [
//             "luas_kolam" =>  [
//                 'kecil'   =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
//                 'besar'    =>  FUZZY_MEMBERSHIP_LINEAR_UP
//             ],
//             [65, 112]
//         ],
//         [
//             "jumlah_bibit" => [
//                 'sedikit'    =>  [
//                     'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
//                     'domain'        =>  [10000, 17000]
//                 ],
//                 'banyak'    =>  [
//                     'membership'    =>  FUZZY_MEMBERSHIP_LINEAR_UP,
//                     'domain'        =>  [17000, 23000]
//                 ]
//             ]
//         ],
//         [
//             "jumlah_pakan" =>  [
//                 'sedikit'    =>  FUZZY_MEMBERSHIP_LINEAR_DOWN,
//                 'banyak'     =>  FUZZY_MEMBERSHIP_LINEAR_UP
//             ],
//             [30, 50]
//         ]
//     )
//     ->rules(
//         ['rules'  =>  ["luas_kolam" => "kecil", "jumlah_bibit" => "sedikit", "jumlah_pakan" => "sedikit"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "kecil", "jumlah_bibit" => "sedikit", "jumlah_pakan" => "banyak"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "kecil", "jumlah_bibit" => "banyak", "jumlah_pakan" => "sedikit"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "kecil", "jumlah_bibit" => "banyak", "jumlah_pakan" => "banyak"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "besar", "jumlah_bibit" => "sedikit", "jumlah_pakan" => "banyak"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "besar", "jumlah_bibit" => "sedikit", "jumlah_pakan" => "sedikit"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "besar", "jumlah_bibit" => "banyak", "jumlah_pakan" => "banyak"], 'result' => 'rendah'],
//         ['rules'  =>  ["luas_kolam" => "besar", "jumlah_bibit" => "banyak", "jumlah_pakan" => "sedikit"], 'result' => 'tinggi']
//     )
//     ->set_values([
//         'luas_kolam' => 100,
//         'jumlah_bibit' => 102,
//         'jumlah_pakan' => 102
//     ])
//     ->execute();
