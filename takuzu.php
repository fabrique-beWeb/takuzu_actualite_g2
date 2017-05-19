<?php

$grille = array ();
$gridTest = 0;
$grille = generateGrid ();
displayGrid($grille);
$grille = checkGrid ($grille);
$grille = returnGrid ($grille);
for ($i = 0; $i < 500; $i++) {
    $grille = returnGrid ($grille);
}
displayGrid($grille);

function checkGrid ($grille) {
    for ($i = 0; $i < 8; $i++) {
        if (!checkTriplon($grille[$i]) || !testlLine ($grille[$i], $i, $grille)) {
            $grille[$i] = generateLine ();
            checkGrid ($grille);
        }
    }

    return $grille;
}

function testlLine ($line, $i, $grille) {
    for ($j = 1; $j < 8; $j++) {
        if ($i != $j && $line == $grille[$j]) {
            return false;
        }
    }
    return true;
}

function checkTriplon($line) {
    $lineTest = "wrong";

    while( $lineTest == "wrong" ) {
        for ($i = 0; $i < 8; $i++) {
            $lineTest = "good";

            if (array_sum($line) != 4) {
                return false;
            };

            if ($i > 1 && $line[$i - 1] == $line[$i - 2] && $line[$i - 1] == $line[$i]) {
                return false;
            }
        }

    }

    return true;
}

// retournement du tableau

function returnGrid($grille){
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            $grille[$i][$j] = $grille[$j][$i];
        }
    }
    $grille = checkGrid ($grille);
    return $grille;
}

// Création de la grille + affichage

function generateGrid () {

    $firstGrid = array();

    for ($i = 0; $i < 8; $i++) {
        $firstGrid[$i] = generateLine ();
    }

    return $firstGrid;
}

function generateLine () {
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

function displayGrid($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            echo $grille[$i][$j];
        }
        echo "\n";
    }
    echo "\n";
}