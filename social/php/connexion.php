<?php
define("HOST", "192.168.0.12");
define("DBNAME", "portefolio_db");
define("DBUSER", "cfpt");
define("DBPWD", "Super");

function connexion() {
    static $dbc = null;

    // Première visite de la fonction
    if ($dbc == null) {
      // Essaie le code ci-dessous
      try {
        $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
          PDO::ATTR_PERSISTENT => true));
       
      }
      // Si une exception est arrivée
      catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        // Quitte le script et meurt
        die('Could not connect to MySQL');
      }
    }
    // Pas d'erreur, retourne un connecteur
    return $dbc;
  }

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
 