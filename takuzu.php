<?php

include 'fonctions.php';

//variables
$grille = array ();
$compteur = 0;
$bad = 0;
$newGrid = 0;
//on remplit la grille
$grille = generateGrid ();
echo "\n";
echo "Calcul en cours ... on attend ...";
echo "\n\n";
//tant que le compteur de tableau non modifié est inférieur à 5 on tourne la grille et on check
while ( $compteur < 5 ) {
    $grille = modifyGrid($grille);
    $grille = returnGrid($grille);
    if (checkGridCorrect($grille)) {
        $compteur++;
    } else {
        $compteur = 0;
        $bad++;
    }
    if ($bad>1500) { $newGrid++; $grille = generateGrid (); $bad = 0; }
}
//on affiche la grille correcte
displayGrid($grille);
echo "On a modifié ".$bad." fois la grilles";
echo "\n";
echo "On a abandonné et regénéré ".$newGrid." fois une nouvelle grille";
echo "\n";

$grillestart = startGrid($grille, 21);
displayGrid($grillestart);
echo "\n";

$grillesolution = array2xml($grille);
$grilleafaire = array2xml($grillestart);
$out = fopen("takuzuafaire.xml", "w");
fwrite($out, $grilleafaire);
fclose($out);
$out = fopen("takuzusolution.xml", "w");
fwrite($out, $grillesolution);
fclose($out);

$grillejson =  json_encode($grille);
$grillestartjson = json_encode($grillestart);
$out = fopen("takuzuafaire.json", "w");
fwrite($out, $grillestartjson);
fclose($out);
$out = fopen("takuzusolution.json", "w");
fwrite($out, $grillejson);
fclose($out);