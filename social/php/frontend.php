<?php
function affichageMedia($estModifiable, $commentaire)
{
  if ($estModifiable) {
    echo '<input type="text" name="nouveauCommentaire" value="' . $commentaire . '">
          <input type="submit" name="modifierCommentaire" value="Ok">
          <label for="img"> <img src="./assets/icon/iconmonstr-photo-camera-4.svg" alt="icon camera"> </label>
          <input type="file" accept="video/*, image/*, audio/*" name="img[]" id="img" multiple>';
  } else {
    echo '<p class="lead">' . $commentaire . '</p><input type="submit" name="modifier" value="Modifier">';
  }
}
