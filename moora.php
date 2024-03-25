<?php 
include 'data.php';

//menghitung bobot kriteria sehingga menjadi skala 0-1 (total = 1)
$sum = 0;
$w = []; // matriks bobot
for ($i=0; $i<count($kriteria); $i++){
    $sum = $sum + $kriteria[$i]['bobot'];
}
for ($i=0; $i<count($kriteria); $i++){
    $w[$i] = $kriteria[$i]['bobot'] / $sum;
}


// spk metode moora

// 1. matriks keputusan (X)
$x = [];
for ($i=0; $i<count($alternatif); $i++){
    if ($alternatif[$i][4] == 'Batu'){            // konversi penilaian alternatif untuk kriteria C4 ke skala yang sudah ditentukan 
        $c4 = 1;
    } else if ($alternatif[$i][4] == 'Papan'){
        $c4 = 2;
    } else {
        $c4 = 3;
    }
    if ($alternatif[$i][5] == 'Milik Sendiri'){   // konversi penilaian alternatif untuk kriteria C5 ke skala yang sudah ditentukan 
        $c5 = 1;
    } else if ($alternatif[$i][5] == 'Kontrak'){
        $c5 = 2;
    } else {
        $c5 = 3;
    }
    if ($alternatif[$i][6] == 'Listrik'){         // konversi penilaian alternatif untuk kriteria C6 ke skala yang sudah ditentukan 
        $c6 = 1;
    } else {
        $c6 = 2;
    }
    if ($alternatif[$i][7] == 'LPG'){             // konversi penilaian alternatif untuk kriteria C7 ke skala yang sudah ditentukan 
        $c7 = 1;
    } else if ($alternatif[$i][7] == 'Minyak Tanah'){
        $c7 = 2;
    } else {
        $c7 = 3;
    }
    if ($alternatif[$i][8] == 'S1'){              // konversi penilaian alternatif untuk kriteria C8 ke skala yang sudah ditentukan 
        $c8 = 1;
    } else if ($alternatif[$i][8] == 'SMA'){
        $c8 = 2;
    } else {
        $c8 = 3;
    }
    $x[] = [$alternatif[$i][1], $alternatif[$i][2], $alternatif[$i][3], $c4, $c5, $c6, $c7, $c8];
}

$n = count($x);       // banyak alternatif/baris
$m = count($x[0]);    // banyak kriteria/kolom

// 2. normalisasi
$r = [];                 // matriks normalisasi
for ($j=0; $j<$m; $j++){
    $sum_kuadrat = 0;     
    for ($i=0; $i<$n; $i++){
        $sum_kuadrat += pow($x[$i][$j], 2);
    }
    $akar = sqrt($sum_kuadrat);
    for ($i=0; $i<$n; $i++){
        $r[$i][$j] = $x[$i][$j] / $akar;       // perhitungan normalisasi
    }
}

// 3. mengalikan hasil normalisasi dengan bobot (optimasi atribut)
$v = [];
for ($i=0; $i<$n; $i++){
    for ($j=0; $j<$m; $j++){
        $v[$i][$j] = $r[$i][$j] * $w[$j];
    }
}

// 4. menentukan nilai y (mengurangi nilai max dan min)
$y = [];
for ($i=0; $i<$n; $i++){  
    $max = 0;
    $min = 0;  
    for ($j=0; $j<$m; $j++){
        if ($kriteria[$j]['jenis'] == 'Benefit'){        // menjumlahkan nilai perhitungan sebelumnya untuk kriteria benefit (max)
            $max = $max + $v[$i][$j];
        } else{                                     // menjumlahkan nilai perhitungan sebelumnya untuk kriteria cost (min)
            $min = $min + $v[$i][$j];
        }
    }
    $y[$i] = ["alt" => $i, "max" => $max, "min" => $min, "y" => ($max-$min)];    // y = max - min
}

// 5. perangkingan
function compare_y($a, $b){
    if ($a['y'] == $b['y']) return 0;
    return ($a['y'] > $b['y'])? -1 : 1;
}
usort($y, "compare_y");


?>