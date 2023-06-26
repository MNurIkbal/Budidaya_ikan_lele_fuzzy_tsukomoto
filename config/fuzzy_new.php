<?php 
$luasKolam = 90;
$jumlahBibit = 14000;
$jumlahPakan = 55;
// function keanggotaan 
function luasKolamMembership($luasKolam) {
    $membership = [];
    
    // Himpunan fuzzy "kecil"
    if ($luasKolam < 65 ) {
        $membership['Kecil'] = 1;
        $membership['Besar'] = 0;
    } elseif ($luasKolam >= 65 && $luasKolam <= 85) {
        $membership['Kecil'] = (112 - $luasKolam) / (112 - 65);
        $membership['Besar'] = 0;
    } 
    
    // Himpunan fuzzy "besar"
    elseif ($luasKolam >= 85 && $luasKolam <= 112) {
        $membership['Besar'] = ($luasKolam - 65) / (112 - 65);
        $membership['Kecil'] = 0;
    } else {
        $membership['Besar'] = 1;
        $membership['Kecil'] = 0;   
    }

    return $membership;
}

function jumlahBibitMembership($jumlahBibit) {
    $membership = [];

    // Himpunan fuzzy "sedikit"
    if ($jumlahBibit < 10000) {
        $membership['Sedikit'] = 1;
        $membership['Banyak'] = 0;
    } elseif ($jumlahBibit >= 10000 && $jumlahBibit <= 17000) {
        $membership['Sedikit'] = (23000 - $jumlahBibit) / (23000 - 10000);
        $membership['Banyak'] = 0;
    } 
    
    // Himpunan fuzzy "banyak"
    elseif ($jumlahBibit > 17000 && $jumlahBibit <= 23000) {
        $membership['Banyak'] = ($jumlahBibit - 10000) / (23000 - 10000);
        $membership['Sedikit'] = 0;
    } else {
        $membership['Banyak'] = 1;
        $membership['Sedikit'] = 0;
    }

    return $membership;
}

function jumlahPakanMembership($jumlahPakan) {
    $membership = [];

    // Himpunan fuzzy "sedikit"
    if ($jumlahPakan < 30) {
        $membership['Sedikit'] = 1;
        $membership['Banyak'] = 0;
    } elseif ($jumlahPakan >= 30 && $jumlahPakan <= 50) {
        $membership['Sedikit'] = (69 - $jumlahPakan) / (69 - 30);
        $membership['Banyak'] = 0;
    }
    
    // Himpunan fuzzy "banyak"
    elseif ($jumlahPakan > 50 && $jumlahPakan <= 69) {
        $membership['Sedikit'] = 0;
        $membership['Banyak'] = ($jumlahPakan - 30) / (69 - 30);
    } else {
        $membership['Banyak'] = 1;
        $membership['Sedikit'] = 0;
    }

    return $membership;
}


function predikat($variabel, $nilai, $fungsiKeanggotaan) {
    $predikat = [];

    foreach ($fungsiKeanggotaan[$variabel] as $fungsi) {
        $namaFungsi = $fungsi[0];
        $parameter = $fungsi[1];
        
        
        if ($nilai >= $parameter[0] && $nilai <= $parameter[1]) {
            if ($namaFungsi == 'Kecil') {
                $alpha = ($parameter[1] - $nilai) / ($parameter[1] - $parameter[0]);
            } elseif ($namaFungsi == 'Besar') {
                $alpha = ($nilai - $parameter[0]) / ($parameter[1] - $parameter[0]);
            } 
            elseif($namaFungsi == "Sedikit") {
                $alpha = ($parameter[1] - $nilai) / ($parameter[1] - $parameter[0]);
            } elseif($namaFungsi == "Banyak") {
                $alpha = ($nilai - $parameter[0]) / ($parameter[1] - $parameter[0]);
            }
            else {
                $alpha = 1;
            }
            
            
            $predikat[] = $alpha;
        } else {
            $predikat[] = 0;
        }
    }

    return $predikat;
}

// Definisi fungsi keanggotaan
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

$predikatLuasKolam = predikat('luasKolam', $luasKolam, $fungsiKeanggotaan);
$predikatJumlahBibit = predikat('jumlahBibit', $jumlahBibit, $fungsiKeanggotaan);
$predikatJumlahPakan = predikat('jumlahPakan', $jumlahPakan, $fungsiKeanggotaan);
echo "Predikat Luas Kolam: ";
print_r($predikatLuasKolam);

echo "<br>Predikat Jumlah Bibit: ";
print_r($predikatJumlahBibit);

echo "<br>Predikat Jumlah Pakan: ";
print_r($predikatJumlahPakan);
die;




function inferensi($luasKolam, $jumlahBibit, $jumlahPakan) {
    // Menghitung predikat berdasarkan aturan fuzzy
    $predikat = calculateRules($luasKolam, $jumlahBibit, $jumlahPakan);
    
    // Menghitung bobot untuk masing-masing hasil predikat
    $bobot = array();
    $bobot['Rendah'] = max($predikat[0], $predikat[1], $predikat[2], $predikat[3]);
    $bobot['Tinggi'] = max($predikat[4], $predikat[5], $predikat[6], $predikat[7]);
    
    return $bobot;
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

function defuzzifikasi($agregasi) {
    $numerator = 0;
    $denominator = 0;

    foreach ($agregasi as $output => $value) {
        // Menentukan bobot berdasarkan nilai keluaran fuzzy
        $bobot = getBobot($output);

        // Menentukan nilai yang akan dikontribusikan pada defuzzifikasi
        $kontribusi = $value * $bobot;

        // Mengakumulasikan nilai numerik dan denumerator
        $numerator += $kontribusi;
        $denominator += $value;
    }

    // Menghindari pembagian dengan nol
    if ($denominator == 0) {
        return 0;
    }

    // Menghitung hasil defuzzifikasi
    $hasilDefuzzifikasi = $numerator / $denominator;

    return $hasilDefuzzifikasi;
}

function getBobot($output) {
    // Menentukan bobot berdasarkan keluaran fuzzy
    switch ($output) {
        case 'rendah':
            return 0;
        case 'tinggi':
            return 1;
        default:
            return 0; // Default bobot jika keluaran fuzzy tidak ditemukan
    }
}


?>