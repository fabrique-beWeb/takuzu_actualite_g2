<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Takuzu</title>
<style>
td {border: 1px black solid; text-align: center; width: 50px; height: 50px;}
</style>
</head>
<body>

<table>
<tbody id="grille">
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

<p>On a modifié <?php echo $bad ?> fois la grille</p>
<p>On a abandonné et regénéré <?php echo $newGrid ?> fois une nouvelle grille</p>
<p>Exécution du script :  <?php $timestamp_fin = microtime(true);
    $difference_ms = $timestamp_fin - $timestamp_debut;
    echo round($difference_ms, 2) ?> secondes</p>
<button onclick="generate()">Générer les fichiers</button>
<script src="jquery-3.2.1.min.js"></script>
<script src="jspdf.js"></script>
<script src="html2canvas.js"></script>
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