<?php

$nb=0;
$grille = array();
$grille = generate_h($grille);
display_grid($grille);
echo "\n";
$grille = check_grid($grille);
display_grid($grille);

function check_grid($grille){
    $grille = return_grid($grille);
    $grid_wrong = false;
    echo "\n";
    display_grid($grille);

    for ($i = 0; $i < 8; $i++) {
        while(checkIdenticalLine($i, $grille, $grille[$i])) {
            $grille[$i] = generate_line ();
            $grid_wrong = true;
        }

        $grille[$i] = check_triplon($grille[$i]);

    }

    /*sleep(5);*/
    echo "\n";
    display_grid($grille);


    while($grid_wrong = true) {
        check_grid($grille);
    }
    return $grille;
}


function check_triplon($line) {
    for ($j = 0; $j < 8; $j++) {
        if ($j > 1 && $line[$j - 1] == $line[$j - 2]) {
            if ($line[$j - 1] == 0) $line[$j] = 1;
            else $line[$j] = 0;
        }else  $line[$j] = rand(0, 1);
    }

    while (array_sum($line) != 4) { $line = generate_line (); check_triplon($line); }
    return $line;
}

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

function generate_h() {

    for ($i = 0; $i < 8; $i++) {
        $grille[$i] = generate_line ();

        while(checkIdenticalLine($i, $grille, $grille[$i])) {
            $grille[$i] = generate_line ();
        }
    }

    return $grille;
}

function checkIdenticalLine($nb, $grille, $current_line){
    for ($i = 0; $i < $nb; $i++) {
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
                else $line[$i] = 0;
            }else  $line[$i] = rand(0, 1);
        }
    }
    return $line;
}