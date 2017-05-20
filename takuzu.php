<?php

//variables
$grille = array ();
//on remplit la grille
$grille = generateGrid ();
//on affiche la grille fausse normalement
displayGrid($grille);

for ($i = 0; $i < 500000; $i++) {
    $grille = returnGrid($grille);
    $grille = checkGrid($grille);
}

displayGrid($grille);

function checkGrid ($grille) {
    $correct = true;
    for ($i = 0; $i < 8; $i++) {
        if (!checkTriplon($grille[$i])) {
            $grille[$i] = modifyTriplon($grille[$i]);
        }

        if (!testlLine ($grille[$i], $i, $grille)) {
            while(!testlLine ($grille[$i], $i, $grille)) {
                $grille[$i] = generateLine();
            }
        }
    }

//    while ($correct == false) { $grille = checkGrid($grille); }
    return $grille;
}



//vérifie la verticale pour les triplons

function testlColumnTriplon ($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            if ($j >1 && $grille[$j][$i] == $grille[$j-1][$i] && $grille[$j-1][$i] == $grille[$j-2][$i]) {
                if ($grille[$j-1][$i] == 0) {
                    $grille[$j][$i] = 1;
                    testlColumnTriplon ($grille);
                } else {
                    $grille[$j][$i] = 0;
                    testlColumnTriplon ($grille);
                }
            }
        }
    }

    return $grille;
}

function testlLine ($line, $i, $grille) {
    for ($j = 0; $j < 8; $j++) {
        if ($i != $j && $line == $grille[$j]) {
            return false;
        }
    }
    return true;
}

function modifyTriplon($line) {
    $lineTest = "wrong";
    while( $lineTest == "wrong" ) {

        for ($i = 0; $i < 8; $i++) {
            $lineTest = "good";
            while(array_sum($line) != 4 ) {
                if (array_sum($line) != 4) {
                    $line = generateLine();
                }
            }
            if ($i > 1) {
                while ($line[$i - 1] == $line[$i - 2] && $line[$i] == $line[$i - 1]) {
                    if ($line[$i - 1] == 0) $line[$i] = 1;
                    else $line[$i] = 0;
                    $lineTest = "wrong";
                }
            }
        }
    }

    return $line;
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
    $grilleTemp = $grille;
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            $grilleTemp[$j][7-$i] = $grille[$i][$j];
        }
    }
    return $grilleTemp;
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