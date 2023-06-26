<?php 
// function keanggotaan 
function luasKolamMembership($luasKolam) {
    $membership = [];

    // Himpunan fuzzy "kecil"
    if ($luasKolam <= 65) {
        $membership['Kecil'] = 1;
    } elseif ($luasKolam > 65 && $luasKolam <= 112) {
        $membership['Kecil'] = (112 - $luasKolam) / (112 - 65);
    } else {
        $membership['Kecil'] = 0;
    }

    // Himpunan fuzzy "besar"
    if ($luasKolam <= 65) {
        $membership['Besar'] = 0;
    } elseif ($luasKolam > 65 && $luasKolam <= 112) {
        $membership['Besar'] = ($luasKolam - 65) / (112 - 65);
    } else {
        $membership['Besar'] = 1;
    }

    return $membership;
}


function jumlahBibitMembership($jumlahBibit) {
    $membership = [];

    // Himpunan fuzzy "sedikit"
    if ($jumlahBibit <= 10000) {
        $membership['Sedikit'] = 1;
    } elseif ($jumlahBibit > 10000 && $jumlahBibit <= 23000) {
        $membership['Sedikit'] = (23000 - $jumlahBibit) / (23000 - 10000);
    } else {
        $membership['Sedikit'] = 0;
    }

    // Himpunan fuzzy "banyak"
    if ($jumlahBibit <= 10000) {
        $membership['Banyak'] = 0;
    } elseif ($jumlahBibit > 10000 && $jumlahBibit <= 23000) {
        $membership['Banyak'] = ($jumlahBibit - 10000) / (23000 - 10000);
    } else {
        $membership['Banyak'] = 1;
    }

    return $membership;
}

function jumlahPakanMembership($jumlahPakan) {
    $membership = [];

    // Himpunan fuzzy "sedikit"
    if ($jumlahPakan <= 30) {
        $membership['Sedikit'] = 1;
    } elseif ($jumlahPakan > 30 && $jumlahPakan <= 69) {
        $membership['Sedikit'] = (69 - $jumlahPakan) / (69 - 30);
    } else {
        $membership['Sedikit'] = 0;
    }

    // Himpunan fuzzy "banyak"
    if ($jumlahPakan <= 30) {
        $membership['Banyak'] = 0;
    } elseif ($jumlahPakan > 30 && $jumlahPakan <= 69) {
        $membership['Banyak'] = ($jumlahPakan - 30) / (69 - 30);
    } else {
        $membership['Banyak'] = 1;
    }

    return $membership;
}

function hasilPanenMembership($hasilPanen) {
    $membership = [];

    // Himpunan fuzzy "rendah"
    if ($hasilPanen <= 810) {
        $membership['rendah'] = 1;
    } elseif ($hasilPanen > 810 && $hasilPanen <= 2070) {
        $membership['rendah'] = (2070 - $hasilPanen) / (2070 - 810);
    } else {
        $membership['rendah'] = 0;
    }

    // Himpunan fuzzy "tinggi"
    if ($hasilPanen <= 810) {
        $membership['tinggi'] = 0;
    } elseif ($hasilPanen > 810 && $hasilPanen <= 2070) {
        $membership['tinggi'] = ($hasilPanen - 810) / (2070 - 810);
    } else {
        $membership['tinggi'] = 1;
    }

    return $membership;
}



// Fungsi Imply
// function imply($luasKolam, $jumlahBibit, $jumlahPakan) {
//     $hasilImply = [];

//     // Rule 1: IF Kecil AND Sedikit AND Banyak THEN Rendah
    
//     $hasilImply['Rendah'] = min($luasKolam['Kecil'], $jumlahBibit['Sedikit'], $jumlahPakan['Banyak']);
//     // Rule 2: IF Kecil AND Sedikit AND Sedikit THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Kecil'], $jumlahBibit['Sedikit'], $jumlahPakan['Sedikit']));

//     // Rule 3: IF Kecil AND Banyak AND Banyak THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Kecil'], $jumlahBibit['Banyak'], $jumlahPakan['Banyak']));

//     // Rule 4: IF Kecil AND Banyak AND Sedikit THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Kecil'], $jumlahBibit['Banyak'], $jumlahPakan['Sedikit']));

//     // Rule 5: IF Besar AND Sedikit AND Sedikit THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Besar'], $jumlahBibit['Sedikit'], $jumlahPakan['Sedikit']));

//     // Rule 6: IF Besar AND Sedikit AND Banyak THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Besar'], $jumlahBibit['Sedikit'], $jumlahPakan['Banyak']));

//     // Rule 7: IF Besar AND Banyak AND Sedikit THEN Rendah
//     $hasilImply['Rendah'] = max($hasilImply['Rendah'], min($luasKolam['Besar'], $jumlahBibit['Banyak'], $jumlahPakan['Sedikit']));

//     // Rule 8: IF Besar AND Banyak AND Banyak THEN Tinggi
//     $hasilImply['Tinggi'] = min($luasKolam['Besar'], $jumlahBibit['Banyak'], $jumlahPakan['Banyak']);

//     return $hasilImply;
// }

function calculateRules($luasKolam, $jumlahBibit, $jumlahPakan) {
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

function fuzzyTsukamoto($luasKolam, $jumlahBibit, $jumlahPakan) {
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

$luasKolam = 80;
$jumlahBibit = 15000;
$jumlahPakan = 40;

$hasilTsukamoto = fuzzyTsukamoto($luasKolam, $jumlahBibit, $jumlahPakan);
echo "Hasil Fuzzy Tsukamoto: " . $hasilTsukamoto;

die;
// Fungsi Agregasi
// function aggregate($hasilImply) {
//     $agregat = [];

//     // Menentukan nilai agregat Rendah
//     $agregat['Rendah'] = $hasilImply['Rendah'];

//     // Menentukan nilai agregat Tinggi
//     $agregat['Tinggi'] = $hasilImply['Tinggi'];

//     return $agregat;
// }

// // Fungsi Defuzzifikasi (Centroid)
// function defuzzification($aggregatedResult) {
//     $numerator = 0;
//     $denominator = 0;

//     foreach ($aggregatedResult as $key => $value) {
//         $numerator += ($key * $value);
//         $denominator += $value;
//     }
   
//     if ($denominator == 0) {
//         return 0; // handle jika pembagi adalah nol untuk menghindari pembagian dengan nol
//     }

//     $defuzzifiedValue = $numerator / $denominator;

//     return $defuzzifiedValue;
// }

// $luasKolam = 70;
// $jumlahBibit = 50;
// $jumlahPakan = 70;

// // Menghitung derajat keanggotaan

// $luasKolamMembership = luasKolamMembership($luasKolam);
// $jumlahBibitMembership = jumlahBibitMembership($jumlahBibit);
// $jumlahPakanMembership = jumlahPakanMembership($jumlahPakan);

// var_dump($luasKolamMembership);
// die;
// // Melakukan implikasi

// $hasilImply = imply($luasKolamMembership, $jumlahBibitMembership, $jumlahPakanMembership);
// // Melakukan agregasi   

// $agregat = aggregate($hasilImply);


// // Melakukan defuzzifikasi

// $defuzzifikasi = defuzzification($agregat);

// // Menampilkan hasil defuzzifikasi

// echo "Hasil defuzzifikasi: " . $defuzzifikasi;
?>