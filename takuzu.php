<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Takuzu</title>
<style>
td {border: 1px black solid; text-align: center; width: 25px; height: 25px;}
</style>
</head>
<body>

<table>
<tbody>
<?php
include 'fonctions.php';
//variables
$grille = array ();
$compteur = 0;
$bad = 0;
$newGrid = 0;
$timestamp_debut = microtime(true);
//on remplit la grille
$grille = generateGrid ();
echo "\n";
echo "Calcul en cours ... on attend ...\n\n";
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
    if ($bad>1000) { $newGrid++; $grille = generateGrid (); $bad = 0; }
}
	// pour chaque ligne
	for ($i=1; $i<8; $i++)
    {
        ?>
        <tr>
            <?php		// pour chaque colonne (de la ligne)
            for ($j=1; $j<8; $j++)
            {
                ?>		<td>
                <?php
                echo $grille[$i][$j];
                ?>		</td>
            <?php	} // end for
            ?>
        </tr>
        <?php
    } // end for
?>
</tbody>
</table>

</body>
</html>

<?php
echo "On a modifié ".$bad." fois la grille\n";
echo "On a abandonné et regénéré ".$newGrid." fois une nouvelle grille\n";
$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo "Exécution du script : " . round($difference_ms, 2) . " secondes\n";