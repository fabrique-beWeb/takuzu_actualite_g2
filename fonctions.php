<?php
/**
* Modifie les lignes de la grille qui sont incorrectes.
* Les triplons de chiffres
* Les lignes qui ne sont pas égales à 4
* Les lignes identiques
*
* @param la grille de jeux à tester
*
* @return la grille modifiée
*/
function modifyGrid ($grille) {
for ($i = 0; $i < 8; $i++) {
if (!checkTriplon($grille[$i])) {
$grille[$i] = modifyTriplon($grille[$i]);
}

if (!testLine ($grille[$i], $i, $grille)) {
while(!testLine ($grille[$i], $i, $grille)) {
$grille[$i] = generateLine();
}
}
}

return $grille;
}



/**
* Modifie une ligne qui contient des triplons ou n'est pas égales à 4
*
* @param la ligne de la grille à modifier
*
* @return la ligne modifiée
*/
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

/**
* Vérifie si les lignes de la grille sont correctes.
* Pas de triplon sur chaque ligne
* Chaque ligne est égale à 4
* Pas 2 lignes identiques
*
* @param la grille de jeux à tester
*
* @return boolean
*/
function checkGridCorrect ($grille) {
for ($i = 0; $i < 8; $i++) {
if ( !checkTriplon($grille[$i]) ) {
return false;
}

if ( !testLine ($grille[$i], $i, $grille) ) {
return false;
}
}

return true;
}

/**
* Retourne le tableau afin que les lignes deviennent les colonnes
* 90° à droite
*
* @param la grille de jeux à retourner
*
* @return la grille retournée
*/
function returnGrid($grille){
$grilleTemp = $grille;
for ($i = 0; $i < 8; $i++) {
for ($j = 0; $j < 8; $j++) {
$grilleTemp[$j][7-$i] = $grille[$i][$j];
}
}
return $grilleTemp;
}

//Fonctions de test

/**
* Vérifie si une ligne est égale à une autre ligne de la grille
*
* @param la ligne de la grille à tester
*
* @return boulean
*/
function testLine ($line, $i, $grille) {
for ($j = 0; $j < 8; $j++) {
if ($i != $j && $line == $grille[$j]) {
return false;
}
}
return true;
}

/**
* Vérifie si une ligne contient des triplons de chiffre
*
* @param la ligne de la grille à tester
*
* @return boulean
*/
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

//Fonctions de génération de grille ou ligne

/**
* Génère un tableau de 8x8 contenant des 1 & des 0
*
* @param void
*
* @return la grille générée
*/

function generateGrid () {

$firstGrid = array();

for ($i = 0; $i < 8; $i++) {
$firstGrid[$i] = generateLine ();
}

return $firstGrid;
}

/**
* Génère un tableau de 8 contenant des 1 & des 0
* Représente une ligne de la grille de jeux
*
* @param void
*
* @return la ligne générée
*/
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

/**
* Affiche la grille de jeux
*
* @param un tableau de 8x8 representant la grille de jeux
*
* @return la grille de jeux
*/
function displayGrid($grille) {
for ($i = 0; $i < 8; $i++) {
for ($j = 0; $j < 8; $j++) {
echo $grille[$i][$j]." ";
}
echo "\n";
}
echo "\n";
}