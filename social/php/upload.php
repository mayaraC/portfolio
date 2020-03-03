<?php 
/********************************************
 * Uploader des images, vidéos, audios et commentaire dans la base de données
 *******************************************/
include 'connexion.php';


//Ajouter des medias et des commentaires --------------------------------------------------------------------------------------
function ajouterMedia($typeMedia, $nomMedia, $post_idPost) {
  
  //Requête
  $sql = "INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`, `modificationDate`,`post_idPost`) VALUES (:typeMedia, :nomMedia, NOW(), NOW(),:post_idPost)";

  try {
    $dbh = connexion();
    $dbh->beginTransaction();
    //Envoyer la requête à la base de données
    $query = $dbh->prepare($sql);

    // Exécuter la requete en donnant les infos
    $query->execute([
                ':typeMedia' => $typeMedia,
                ':nomMedia' => $nomMedia,
                ':post_idPost' => $post_idPost
    ]);
    
    $dbh->commit();
    return true;
    
  } catch (PDOException $th) {
    echo $th->getMessage();
    $dbh->rollBack();
  }    
}

function ajouterCommentaire($commentaire) {
  
  //Requête
  $sql = "INSERT INTO `post`(`commentaire`, `creationDate`) VALUES (:commentaire, NOW())";

  try {
    $dbh = connexion();
    $dbh->beginTransaction();
    //Envoyer la requête à la base de données
    $query = $dbh->prepare($sql);

    // Exécuter la requete en donnant les infos
    $query->execute([':commentaire' => $commentaire ]);
    $tmp = $dbh->lastInsertId();
    $dbh->commit(); 
    return $tmp;
  } catch (PDOException $th) {
    echo $th->getMessage();
    $dbh->rollBack();
  }
  
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
  $reponse = connexion()->query("SELECT nomMedia, typeMedia, commentaire, media.creationDate, Post_idPost from media, post where post.idPost = media.Post_idPost ORDER BY media.creationDate DESC");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}
function afficherImagesOuCommentaire() {
  //Requête
  $reponse = connexion()->query("SELECT  idPost, commentaire from post where NOT EXISTS (SELECT media.post_idPost, media.creationDate FROM media WHERE post.idPost = media.post_idPost ORDER BY media.creationDate DESC) ");

  //Envoyer la requête à la base de données
  $res = $reponse->fetchAll();

  return $res;
}

//Supprimer des images et des commentaires --------------------------------------------------------------------------------------
function effacerMediaCommenatire($id, $dossier, $nomMedia) {
  //Requête
  $sql = "DELETE FROM `media` WHERE  Post_idPost = :id";
  try{
    $dbh = connexion();
    $dbh->beginTransaction();

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
      
      $query->execute() ;
      
      $dbh->commit();
      unlink($dossier.$nomMedia);
      return true;
   }

  } catch(PDOException $th){
    echo $th->getMessage();
    $dbh->rollback();
  }

 return false;
}
//Modifier des images et des commentaires --------------------------------------------------------------------------------------
function modifierMediaCommenatire($id) {
  //Requête
  $sql = "DELETE FROM `media` WHERE  Post_idPost = :id";
  try{
    $dbh = connexion();
    $dbh->beginTransaction();

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
      
      $query->execute() ;
      $dbh->commit();

      return true;
   }

  } catch(PDOException $th){
    echo $th->getMessage();
    $dbh->rollback();
  }

 return false;
}
