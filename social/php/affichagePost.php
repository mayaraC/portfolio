<?php
/********************************************
 * Ce code permet de supprimer des images et des commentaires ainsi que les modifier
 *******************************************/
$idCommentaire = filter_input(INPUT_POST, 'idCommentaire', FILTER_SANITIZE_STRING);
$nomMedia = filter_input(INPUT_POST, 'media', FILTER_SANITIZE_STRING);
$dossier = filter_input(INPUT_POST, 'dossier', FILTER_SANITIZE_STRING);

if (isset($_POST['supprimer']) == 'Supprimer') {
    if(file_exists($dossier.$nomMedia)){
        effacerMediaCommenatire($idCommentaire, $dossier, $nomMedia);
    }else
        effacerMediaCommenatire($idCommentaire, $dossier, $nomMedia);
  }
if (isset($_POST['modifier']) == 'Modifier') {
    modifierMediaCommenatire($id);
}
?>