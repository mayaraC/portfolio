<?php
define("HOST", "localhost");
define("DBNAME", "portofolio_db");
define("DBUSER", "root");
define("DBPWD", "root");

function connexion() {
    static $dbc = null;
  
    // Première visite de la fonction
    if ($dbc == null) {
      // Essaie le code ci-dessous
      try {
        $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
          PDO::ATTR_PERSISTENT => true));
          echo "lol";
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

  function ajouterMedia($typeMedia , $nomMedia , $creationDate , $modificationDate) {

    try {
        //Requête
        $sql = "INSERT INTO `media`(`typeMedia`, `nomMedia`, `creationDate`, `modificationDate`) VALUES ( :typeMedia, :nomMedia, :creationDate, :modificationDate)";

        //Envoyer la requête à la base de données
        $query = connexion()->prepare($sql);

        // Exécuter la requete en donnant les infos
        return $query->execute([
                    ':typeMedia' => $typeMedia,
                    ':nomMedia' => $nomMedia,
                    ':creationDate' => date("Y-m-d"),
                    ':modificationDate' => date("Y-m-d"),
        ]);
    } catch (Exception $ex) {
        if ($ex->getCode() == 23000)
            return FALSE;
        echo $ex->getMessage();
        return FALSE;
    }
    return TRUE;
}
?>
 