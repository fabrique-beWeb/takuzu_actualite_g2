<?php

$tab[] = array();
for ($i = 0; $i <= 7; $i++) {
    $ligne = 0;
    for ($j = 0; $j <= 7; $j++) {
        $tab[$i][$j] = verifH($i, $j, $tab);
        $ligne .= $tab[$i][$j];
        if ($j == 7) {
            if (array_sum($tab[$i]) != 4) {
                $j = 0;
                $ligne = 0;
            } elseif ($i > 1 && check_triplon($tab)) {
                if (verifLigne($i, $tab, $ligne) == false) {
                    $j = 0;
                }
            }
        }
    }
}

display_grid($tab);
echo "\n";
if(!verif_global($tab))
    echo "toto";

function verif($i, $j, $tab) {
    if ($i > 1)
        $v = verifV($i, $j, $tab);
    else
        $v = true;
    if ($j > 1)
        $h = verifH($i, $j, $tab);
    else
        $h = true;
    if ($h != true && $v == true)
        return $h;
    elseif ($h == true && $v != true)
        return $v;
    else
        return rand(0, 1);
}

function verifH($i, $j, $tab) {
    if ($j > 1 && $tab[$i][$j - 2] == $tab[$i][$j - 1]) {
        if ($tab[$i][$j - 2] == 0)
            $val = 1;
        else
            $val = 0;
    } else
        $val = rand(0, 1);
//        $val = true;
    return $val;
}

function verifV($i, $j, $tab) {
    if ($tab[$i - 2][$j] == $tab[$i - 1][$j]) {
        if ($tab[$i - 1][$j] == 0)
            $val = 1;
        else
            $val = 0;
    } else
        $val = rand(0, 1);
//        $val = true;
    return $val;
}

function verifLigne($nb, $tab, $l) {
    for ($i = 0; $i <= $nb - 1; $i++) {
        $ligne = "";
        for ($j = 0; $j <= 7; $j++) {
            $ligne .= $tab[$i][$j];
        }
        if ($l == $ligne)
            return false;
    }
    return true;
}

function verifColonne($nb, $tab, $l) {
    for ($i = 0; $i <= $nb - 1; $i++) {
        $ligne = "";
        for ($j = 0; $j <= 7; $j++) {
            $ligne .= $tab[$j][$i];
        }
        if ($l == $ligne)
            return false;
    }
    return true;
}

function display_grid($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            echo $grille[$i][$j] . " ";
        }
        echo "\n";
    }
}

function check_triplon($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            if ($j > 1 && $grille[$i][$j - 1] == $grille[$i][$j - 2]) {
                return false;
            }
        }
    }
    return true;
}

function verif_ligne($grille) {
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($grille[$i] == $grille[$j])
                return false;
        }
    }
    return true;
}

function verif_somme($grille){
    for ($i = 0; $i < 8; $i++) {
        if(array_sum($grille[$i])!=4)
                return false;
        
    }
    return true;
}

function verif_global($grille){
    $etat = true;
    if(verif_ligne($grille)==false){ $etat = false; echo "toto"; }
    
    if(check_triplon($grille)==false) $etat = false;
    if(verif_somme($grille)==false) $etat = false;
    return $etat;
}
