<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Takuzu</title>
<style>
td {border: 1px black solid; text-align: center; width: 50px; height: 50px;}
table { margin-top: 20px;}
</style>
</head>
<body>
<?php
include 'fonctions.php';
include 'arraytoxml.php';
//variables
$grille = array ();
$compteur = 0;
$bad = 0;
$newGrid = 0;
$timestamp_debut = microtime(true);
//on remplit la grille
$grille = generateGrid ();
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

$grillestart = startGrid($grille, 21);

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
?>
<table>
    <tbody id="grillesolution">
<?php
	// pour chaque ligne
	for ($i=0; $i<8; $i++)
    {
        ?>
        <tr>
            <?php		// pour chaque colonne (de la ligne)
            for ($j=0; $j<8; $j++)
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

<table>
    <tbody id="grilleafaire">
    <?php
    // pour chaque ligne
    for ($i=0; $i<8; $i++)
    {
        ?>
        <tr>
            <?php		// pour chaque colonne (de la ligne)
            for ($j=0; $j<8; $j++)
            {
                ?>		<td>
                <?php
                echo $grillestart[$i][$j];
//                if ($grillestart[$i][$j]== "_") { echo " ";} else {echo $grillestart[$i][$j];};
                ?>		</td>
            <?php	} // end for
            ?>
        </tr>
        <?php
    } // end for
    ?>
    </tbody>
</table>
<p>On a modifié <?php echo $bad ?> fois la grille</p>
<p>On a abandonné et regénéré <?php echo $newGrid ?> fois une nouvelle grille</p>
<p>Exécution du script :  <?php $timestamp_fin = microtime(true);
    $difference_ms = $timestamp_fin - $timestamp_debut;
    echo round($difference_ms, 2) ?> secondes</p>
<button onclick="generate()">Générer les fichiers</button>
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/jspdf.js"></script>
<script src="lib/html2canvas.js"></script>
<script>
    function generate() {
        html2canvas($('#grille')).then(function (canvas) {
            canvas = canvas.toDataURL("image/jpg");
                var pdf = new jsPDF('p','pt','a4');
                pdf.addImage(canvas, 'png', 0, 0);
                pdf.save('takuzu.pdf');

            });
    }
</script>
</body>
</html>