<?php
function calculerMoyenne ($chiffre, $chiffre2, $chiffre3){
    $somme = $chiffre + $chiffre2 + $chiffre3;
    return $somme /3;
}

echo calculerMoyenne (15, 9, 18);


function afficherResultat($nom, $moyenne){

    if ($moyenne>=10):
        echo "La moyenne $nom est suffisante";

    else :
        echo "La moyenne $nom est insuffisante" ;
    endif;
}

echo afficherResultat ("Alice", 14);

?>