<?php
/**********************************************
 * Liste d'erreurs possibles
 * *******************************************/
$error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);

switch ($error) {
    case 0:

        break;
    case 1:
        $_SESSION['MessageError'] = "Le fichier dépasse la taille acceptée";
        break;
    case 2:
        $_SESSION['MessageError'] = "Ce fichier n'a pu être ajouté";
        break;
    case 3:
        $_SESSION['MessageError'] = "Ajoutez des images ou un commentaire";
        break;    
}

function displayError()
{
    if (isset($_GET['error'])) 
        echo $_SESSION['MessageError'];   
}
?>