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
  $result = $query->execute([':commentaire' => $commentaire
  ]);
  
  if ($result == false){
    return false;
  }else
    return connexion()->lastInsertId();
}
//Afficher des images et des commentaires --------------------------------------------------------------------------------------
function afficherCommentaire() {
  //Requête
  $reponse = connexion()->query("SELECT `idPost`, `commentaire`, `creationDate`, `modificationDate` FROM `post` ORDER BY creationDate DESC");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
function afficherImagesEtCommentaire() {
  //Requête
  $reponse = connexion()->query("SELECT nomMedia, commentaire, media.creationDate, Post_idPost from media, post where post.idPost = media.Post_idPost ORDER BY media.creationDate DESC");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
function afficherImagesOuCommentaire() {
  //Requête
  $reponse = connexion()->query("SELECT distinct commentaire from media, post where post.idPost != media.Post_idPost ");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}

//Supprimer des images et des commentaires --------------------------------------------------------------------------------------
function effacerMediaCommenatire($id) {
  Start();
  //Requête
  $sql = "DELETE FROM `media` WHERE  Post_idPost = :id";
  

  //Envoyer la requête à la base de données
  $query = connexion()->prepare($sql);

  // Exécuter la requete en donnant les infos
  $query->bindparam(':id', $id, PDO::PARAM_INT);
 
  if($query->execute() == true){
    //Requête
   $sql = "DELETE FROM `post` WHERE  idPost = :id";
  

    //Envoyer la requête à la base de données
    $query = connexion()->prepare($sql);

    // Exécuter la requete en donnant les infos
    $query->bindparam(':id', $id, PDO::PARAM_INT);
    Commit();
    return $query->execute() ;
 }
 RollBack();
 return false;
}
//Transaction----------------
function Start(){
  $dbh->beginTransaction();
}
function Commit(){
  $dbh->Commit();
}
function RollBack(){
  $dbh->rollBack();
}
?>