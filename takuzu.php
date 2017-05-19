<?php

$grille = array();

for ($i = 0; $i < 8; $i++) {
    $grille[$i] = generate_line ();

    while(checkIdenticalLine($i, $grille, $grille[$i])) {
        $grille[$i] = generate_line ();
    }

    for ($j = 0; $j < 8; $j++) {
        echo $grille[$i][$j];
    }

    echo"\n";
}

function checkIdenticalLine($nb, $grille, $current_line){
    for ($i = 0; $i <= $nb-1; $i++) {
        if ($grille[$i] === $current_line) {
            return true;
        }
    }

    return false;
}

function generate_line () {
    $line = array();
    while(array_sum($line) != 4 ) {
        for ($i = 0; $i < 8; $i++) {         
            if ($i > 1 && $line[$i - 1] == $line[$i - 2]) {
                if ($line[$i - 1] == 0) $line[$i] = 1;
                if ($line[$i - 1] == 1) $line[$i] = 0;
            }else  $line[$i] = rand(0, 1);
        }
    }
    return $line;
}