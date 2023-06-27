    <?php
    $luasKolam = 90;
    $jumlahBibit = 18000;
    $jumlahPakan = 65;
    // function keanggotaan 
    // function luasKolamMembership($luasKolam)
    // {
    //     $membership = [];

    //     // Himpunan fuzzy "kecil"
    //     if ($luasKolam < 65) {
    //         $membership['Kecil'] = 1;
    //         $membership['Besar'] = 0;
    //     } elseif ($luasKolam >= 65 && $luasKolam <= 85) {
    //         $membership['Kecil'] = (112 - $luasKolam) / (112 - 65);
    //         $membership['Besar'] = 0;
    //     }

    //     // Himpunan fuzzy "besar"
    //     elseif ($luasKolam >= 85 && $luasKolam <= 112) {
    //         $membership['Besar'] = ($luasKolam - 65) / (112 - 65);
    //         $membership['Kecil'] = 0;
    //     } else {
    //         $membership['Besar'] = 1;
    //         $membership['Kecil'] = 0;
    //     }

    //     return $membership;
    // }
    function luasKolamMembership($luasKolam)
    {
        $membership = [];

        // Himpunan fuzzy "kecil"
        if ($luasKolam < 65) {
            $membership['Kecil'] = 1;
            $membership['Besar'] = 0;
        } elseif ($luasKolam >= 65 && $luasKolam <= 85) {
            $membership['Kecil'] = (112 - $luasKolam) / (112 - 65);
            $membership['Besar'] = 0;
        } else {
            $membership['Kecil'] = 0;
            $membership['Besar'] = 0; // Set nilai menjadi 0 jika tidak memenuhi kondisi
        }

        // Himpunan fuzzy "besar"
        if ($luasKolam >= 85 && $luasKolam <= 112) {
            $membership['Besar'] = ($luasKolam - 65) / (112 - 65);
            $membership['Kecil'] = 0;
        } elseif ($luasKolam > 112) {
            $membership['Besar'] = 1;
            $membership['Kecil'] = 0;
        }

        return $membership;
    }



    // function jumlahBibitMembership($jumlahBibit)
    // {
    //     $membership = [];

    //     // Himpunan fuzzy "sedikit"
    //     if ($jumlahBibit < 10000) {
    //         $membership['Sedikit'] = 1;
    //         $membership['Banyak'] = 0;
    //     } elseif ($jumlahBibit >= 10000 && $jumlahBibit <= 17000) {
    //         $membership['Sedikit'] = (23000 - $jumlahBibit) / (23000 - 10000);
    //         $membership['Banyak'] = 0;
    //     }

    //     // Himpunan fuzzy "banyak"
    //     elseif ($jumlahBibit > 17000 && $jumlahBibit <= 23000) {
    //         $membership['Banyak'] = ($jumlahBibit - 10000) / (23000 - 10000);
    //         $membership['Sedikit'] = 0;
    //     } else {
    //         $membership['Banyak'] = 1;
    //         $membership['Sedikit'] = 0;
    //     }

    //     return $membership;
    // }

    function jumlahBibitMembership($jumlahBibit)
    {
        $membership = [];

        // Himpunan fuzzy "sedikit"
        if ($jumlahBibit < 10000) {
            $membership['Sedikit'] = 1;
            $membership['Banyak'] = 0;
        } elseif ($jumlahBibit >= 10000 && $jumlahBibit <= 17000) {
            $membership['Sedikit'] = (23000 - $jumlahBibit) / (23000 - 10000);
            $membership['Banyak'] = 0;
        } else {
            $membership['Sedikit'] = 0;
            $membership['Banyak'] = 0; // Set nilai menjadi 0 jika tidak memenuhi kondisi
        }

        // Himpunan fuzzy "banyak"
        if ($jumlahBibit > 17000 && $jumlahBibit <= 23000) {
            $membership['Banyak'] = ($jumlahBibit - 10000) / (23000 - 10000);
            $membership['Sedikit'] = 0;
        } elseif ($jumlahBibit > 23000) {
            $membership['Banyak'] = 1;
            $membership['Sedikit'] = 0;
        }

        return $membership;
    }



    function jumlahPakanMembership($jumlahPakan)
    {
        $membership = [];

        // Himpunan fuzzy "sedikit"
        if ($jumlahPakan < 30) {
            $membership['Sedikit'] = 1;
            $membership['Banyak'] = 0;
        } elseif ($jumlahPakan >= 30 && $jumlahPakan <= 50) {
            $membership['Sedikit'] = (69 - $jumlahPakan) / (69 - 30);
            $membership['Banyak'] = 0;
        } else {
            $membership['Sedikit'] = 0;
            $membership['Banyak'] = 0; // Set nilai menjadi 0 jika tidak memenuhi kondisi
        }

        // Himpunan fuzzy "banyak"
        if ($jumlahPakan > 50 && $jumlahPakan <= 69) {
            $membership['Sedikit'] = 0;
            $membership['Banyak'] = ($jumlahPakan - 30) / (69 - 30);
        } elseif ($jumlahPakan > 69) {
            $membership['Banyak'] = 1;
            $membership['Sedikit'] = 0;
        }

        return $membership;
    }


    // function jumlahPakanMembership($jumlahPakan)
    // {
    //     $membership = [];

    //     // Himpunan fuzzy "sedikit"
    //     if ($jumlahPakan < 30) {
    //         $membership['Sedikit'] = 1;
    //         $membership['Banyak'] = 0;
    //     } elseif ($jumlahPakan >= 30 && $jumlahPakan <= 50) {
    //         $membership['Sedikit'] = (69 - $jumlahPakan) / (69 - 30);
    //         $membership['Banyak'] = 0;
    //     }

    //     // Himpunan fuzzy "banyak"
    //     elseif ($jumlahPakan > 50 && $jumlahPakan <= 69) {
    //         $membership['Sedikit'] = 0;
    //         $membership['Banyak'] = ($jumlahPakan - 30) / (69 - 30);
    //     } else {
    //         $membership['Banyak'] = 1;
    //         $membership['Sedikit'] = 0;
    //     }

    //     return $membership;
    // }






    function calculateRules($luasKolam, $jumlahBibit, $jumlahPakan)
    {
        // Menghitung keanggotaan untuk masing-masing variabel
        $membershipLuasKolam = luasKolamMembership($luasKolam);
        $membershipJumlahBibit = jumlahBibitMembership($jumlahBibit);
        $membershipJumlahPakan = jumlahPakanMembership($jumlahPakan);

        // Menghitung hasil predikat berdasarkan aturan fuzzy
        $predikat = array();

        // Rule 1: IF luas kolam kecil AND jumlah bibit sedikit AND jumlah pakan sedikit THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Kecil'], $membershipJumlahBibit['Sedikit'], $membershipJumlahPakan['Sedikit']);

        // Rule 2: IF luas kolam kecil AND jumlah bibit sedikit AND jumlah pakan banyak THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Kecil'], $membershipJumlahBibit['Sedikit'], $membershipJumlahPakan['Banyak']);

        // Rule 3: IF luas kolam kecil AND jumlah bibit banyak AND jumlah pakan sedikit THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Kecil'], $membershipJumlahBibit['Banyak'], $membershipJumlahPakan['Sedikit']);

        // Rule 4: IF luas kolam kecil AND jumlah bibit banyak AND jumlah pakan banyak THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Kecil'], $membershipJumlahBibit['Banyak'], $membershipJumlahPakan['Banyak']);

        // Rule 5: IF luas kolam besar AND jumlah bibit sedikit AND jumlah pakan banyak THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Besar'], $membershipJumlahBibit['Sedikit'], $membershipJumlahPakan['Banyak']);

        // Rule 6: IF luas kolam besar AND jumlah bibit sedikit AND jumlah pakan sedikit THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Besar'], $membershipJumlahBibit['Sedikit'], $membershipJumlahPakan['Sedikit']);

        // Rule 7: IF luas kolam besar AND jumlah bibit banyak AND jumlah pakan banyak THEN hasil predikat adalah rendah
        $predikat[] = min($membershipLuasKolam['Besar'], $membershipJumlahBibit['Banyak'], $membershipJumlahPakan['Banyak']);

        // Rule 8: IF luas kolam besar AND jumlah bibit banyak AND jumlah pakan sedikit THEN hasil predikat adalah tinggi
        $predikat[] = min($membershipLuasKolam['Besar'], $membershipJumlahBibit['Banyak'], $membershipJumlahPakan['Sedikit']);


        return $predikat;
    }

    function fuzzyTsukamoto($luasKolam, $jumlahBibit, $jumlahPakan)
    {
        // Menghitung predikat berdasarkan aturan fuzzy
        $predikat = calculateRules($luasKolam, $jumlahBibit, $jumlahPakan);

        // Menghitung bobot untuk masing-masing hasil predikat
        $bobot = array();
        $bobot['Rendah'] = max($predikat[0], $predikat[1], $predikat[2], $predikat[3]);
        $bobot['Tinggi'] = max($predikat[4], $predikat[5], $predikat[6], $predikat[7]);

        // Menghitung hasil fuzzy Tsukamoto
        $hasilTsukamoto = ($bobot['Rendah'] * 810 + $bobot['Tinggi'] * 2070) / ($bobot['Rendah'] + $bobot['Tinggi']);

        return $hasilTsukamoto;
    }


    $predikat = calculateRules($luasKolam, $jumlahBibit, $jumlahPakan);
    // var_dump($predikat);
    // die;

    function calculateZ($rules, $zMin = 0, $zMax = 100)
    {
        $totalPredikat = array_sum($rules);
        $z = 0;

        if ($totalPredikat > 0) {
            $zNum = 0;
            $zDen = 0;

            for ($i = 0; $i < count($rules); $i++) {
                $zNum += $rules[$i] * ($i + 1);
                $zDen += $rules[$i];
            }

            $z = $zNum / $zDen;
            $z = $zMin + $z * ($zMax - $zMin);
        }

        return $z;
    }
    $fungsiKeanggotaan = [
        'luasKolam' => [
            ['Kecil', [65, 85]],
            ['Besar', [85, 112]],
        ],
        'jumlahBibit' => [
            ['Sedikit', [10000, 17000]],
            ['Banyak', [17000, 23000]],
        ],
        'jumlahPakan' => [
            ['Sedikit', [30, 50]],
            ['Banyak', [50, 69]],
        ],
    ];

    function fuzzifikasi($variabel, $nilai, $fungsiKeanggotaan)
    {
        $predikat = [];

        foreach ($fungsiKeanggotaan[$variabel] as $fungsi) {
            $namaFungsi = $fungsi[0];
            $parameter = $fungsi[1];

            if ($nilai >= $parameter[0] && $nilai <= $parameter[1]) {
                if ($namaFungsi == 'Sedikit' || $namaFungsi == 'Kecil') {
                    $alpha = ($parameter[1] - $nilai) / ($parameter[1] - $parameter[0]);
                } elseif ($namaFungsi == 'Banyak' || $namaFungsi == "Besar") {
                    $alpha = ($nilai - $parameter[0]) / ($parameter[1] - $parameter[0]);
                } else {
                    $alpha = 1;
                }

                $predikat[] = [$namaFungsi, $alpha];
            } else {
                $predikat[] = [$namaFungsi, 0];
            }
        }

        return $predikat;
    }

    function inferensi($predikatLuasKolam, $predikatJumlahBibit, $predikatJumlahPakan)
    {
        // Implementasikan aturan-aturan logika fuzzy yang sesuai dengan sistem Anda
        // Dalam contoh ini, kita menggunakan aturan sederhana dengan operator AND
    
        $rules = [
            ['Kecil', 'Sedikit', 'Banyak', 'Rendah'],
            ['Kecil', 'Sedikit', 'Sedikit', 'Rendah'],
            ['Kecil', 'Banyak', 'Banyak', 'Rendah'],
            ['Kecil', 'Banyak', 'Sedikit', 'Rendah'],
            ['Besar', 'Sedikit', 'Sedikit', 'Rendah'],
            ['Besar', 'Sedikit', 'Banyak', 'Rendah'],
            ['Besar', 'Banyak', 'Sedikit', 'Rendah'],
            ['Besar', 'Banyak', 'Banyak', 'Tinggi'],
        ];
    
        $hasilInferensi = [];
    
        foreach ($rules as $rule) {
            $luasKolam = $rule[0];
            $jumlahBibit = $rule[1];
            $jumlahPakan = $rule[2];
            $hasil = $rule[3];
            
        
            if (isset($predikatLuasKolam[$luasKolam]) && isset($predikatJumlahBibit[$jumlahBibit]) && isset($predikatJumlahPakan[$jumlahPakan])) {
                $nilaiPredikat = min($predikatLuasKolam[$luasKolam], $predikatJumlahBibit[$jumlahBibit], $predikatJumlahPakan[$jumlahPakan]);
        
                if (!isset($hasilInferensi[$hasil])) {
                    $hasilInferensi[$hasil] = $nilaiPredikat;
                } else {
                    $hasilInferensi[$hasil] = max($hasilInferensi[$hasil], $nilaiPredikat);
                }
            }
        }
    
        return $hasilInferensi;
    }
    
    // Contoh penggunaan:
    $luasKolam = 80;
    $jumlahBibit = 15000;
    $jumlahPakan = 40;
    
    $predikatLuasKolam = fuzzifikasi('luasKolam', $luasKolam, $fungsiKeanggotaan);
    $predikatJumlahBibit = fuzzifikasi('jumlahBibit', $jumlahBibit, $fungsiKeanggotaan);
    $predikatJumlahPakan = fuzzifikasi('jumlahPakan', $jumlahPakan, $fungsiKeanggotaan);
    
    $hasilInferensi = inferensi($predikatLuasKolam, $predikatJumlahBibit, $predikatJumlahPakan);
    
    // Tampilkan hasil inferensi
    echo "Hasil Inferensi: ";
    
    function defuzzifikasi($hasilInferensi, $fungsiKeanggotaanOutput) {
        $totalZ = 0;
        $totalAlpha = 0;
    
        foreach ($hasilInferensi as $hasil => $alpha) {
            $fungsi = $fungsiKeanggotaanOutput[$hasil];
            $z = $fungsi[1]; // Nilai Z pada fungsi keanggotaan output
    
            $totalZ += $alpha * $z;
            $totalAlpha += $alpha;
        }
    
        if ($totalAlpha == 0) {
            return 0;
        }
    
        $hasilDefuzzifikasi = $totalZ / $totalAlpha;
        return $hasilDefuzzifikasi;
    }
    
    // Defuzzifikasi
    $hasilDefuzzifikasi = defuzzifikasi($hasilInferensi, $fungsiKeanggotaanOutput);
    
    // Tampilkan hasil defuzzifikasi
    // echo "Hasil Defuzzifikasi: " . $hasilDefuzzifikasi;
    



    // Menghitung nilai z menggunakan metode Tsukamoto
    // $z = calculateZ($predikat);
    // var_dump($z);

    ?>