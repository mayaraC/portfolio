<?php 
include 'connexion.php';

//Ajouter des medias et des commentaires --------------------------------------------------------------------------------------
function ajouterMedia($typeMedia, $nomMedia, $post_idPost) {
    //Requête
    $sql = "INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`, `modificationDate`,`post_idPost`) VALUES (:typeMedia, :nomMedia, NOW(), NOW(),:post_idPost)";

    //Envoyer la requête à la base de données
    $query = connexion()->prepare($sql);

    // Exécuter la requete en donnant les infos
    return $query->execute([
                ':typeMedia' => "png",
                ':nomMedia' => $nomMedia,
                ':post_idPost' => $post_idPost
    ]);
}

function ajouterCommentaire($commentaire) {
  //Requête
  $sql = "INSERT INTO `post`(`commentaire`, `creationDate`) VALUES (:commentaire, NOW())";

  //Envoyer la requête à la base de données
  $query = connexion()->prepare($sql);

  // Exécuter la requete en donnant les infos
  $query->execute([':commentaire' => $commentaire
  ]);
  return connexion()->lastInsertId();
}
//Afficher des images et des commentaires --------------------------------------------------------------------------------------
function afficherImages() {
  //Requête
  $reponse = connexion()->query("SELECT `idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `modificationDate` FROM `media` ORDER BY idMedia DESC ");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
function afficherCommentaire() {
  //Requête
  $reponse = connexion()->query("SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` ORDER BY idPost DESC");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
//Supprimer des images et des commentaires --------------------------------------------------------------------------------------
function effacer($id) {
  //Requête
  $sql = "DELETE FROM  `typeMedia`, `nomMedia`, `creationDate`, `modificationDate` WHERE `id`=:id";

  //Envoyer la requête à la base de données
  $query = connexion()->prepare($sql);

  // Exécuter la requete en donnant les infos
  $query->bindparam(':id', $id, PDO::PARAM_INT);
  return $query->execute();
}

?>