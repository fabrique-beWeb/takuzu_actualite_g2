<?php

$nb=0;
$grille = generate_h($nb);
$grille = generate_h($nb,$grille);



display_grid($grille);

function return_grid($grille){
    $grille2 = array();

    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            $grille2[$i][$j] = $grille[$j][$i];
        }
    }
    return $grille2;
}

function display_grid($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            echo $grille[$i][$j];
        }
        echo "\n";
    }
}

function generate_h($nb,$grille=null) {

    for ($i = 0; $i < 8; $i++) {
        $good_grid = true;

        if(is_null($grille)) $grille[$i] = generate_line ();

        while(checkIdenticalLine($i, $grille, $grille[$i])) {
            $grille[$i] = generate_line ();
            $nb=0;
            $good_grid = false;
        }
    }

    if(!is_null($grille)) while( $nb < 2) {
        echo "check grille again\n";
        echo $nb + "\n";
        if($good_grid = true) $nb ++;
        $grille = return_grid($grille);
        $grille = generate_h($nb,$grille);
    }

    return $grille;
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
                elseif ($line[$i - 1] == 1) $line[$i] = 0;
            }else  $line[$i] = rand(0, 1);
        }
    }
    return $line;
}