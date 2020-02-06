<?php 
include 'connexion.php';
function ajouterMedia($typeMedia, $nomMedia) {
    //Requête
    $sql = "INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`) VALUES (:typeMedia, :nomMedia, NOW())";

    //Envoyer la requête à la base de données
    $query = connexion()->prepare($sql);

    // Exécuter la requete en donnant les infos
    return $query->execute([
                ':typeMedia' => $typeMedia,
                ':nomMedia' => $nomMedia,
    ]);
}

function afficherImages() {
  //Requête
  $reponse = connexion()->query("SELECT `idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `modificationDate` FROM `media` ");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
?>