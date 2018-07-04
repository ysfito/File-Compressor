<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>File Compress</title>
</head>
<body>
<h5>Entrez un fichier</h5>

<form action="" method="post" enctype="multipart/form-data">

  <fieldset class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" class="form-control-file" id="InputFile" name="file">
    <small class="text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
  </fieldset>

  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<?php


if(isset($_POST['submit']))
{

  $uploaddir_php_memory = 'php://memory'; 
  $uploaddir = '/var/www/html/compressionfile/upload/'; 
  $file_name = $uploaddir.$_FILES['file']['name'];
  $uploadfile=$_FILES['file']['tmp_name'];
  $fichier= file_get_contents($uploadfile);  


echo '<pre>';
      if (!$_FILES["file"]["error"]) {

        /* Elimine les commentaire grace à un regex   */

        $fichier_recu = preg_replace('@(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|((?<!:)//.*)|\x0B|\0|&nbsp|#^(?:\d{2}\.){2}\d{4}#|[\t\r\n]@i',
        '',$fichier)  or die("Unable to open file!"); 

        echo "Le fichier est valide, et a été téléchargé
                 avec succès. Voici plus d'informations :\n";
            /*Créer le fichier dans le dossier upload */

                 $toupload=fopen($file_name,'w+');
              /* on supprime l'ensemble des espace qui sont dans le fichier retourné par le regex, $fichier_recu */
                 $escape_file=str_replace(' ','',$fichier_recu);

              /* On écrit enfin sur le fichier ouvert */
                 $To_upload= fwrite($toupload,$escape_file); 
                
                  echo "Voici quelques informations concernant la votre  du fichier après réduction: \n \n"; 

                  echo "taille du fichier réduit:".  filesize($file_name). "\n";
                  echo "type du fichier réduit".   filetype($file_name). "\n";
                  

      } else {
          echo "Attaque potentielle par téléchargement de fichiers.
                Voici plus d'informations :\n";
      }

      echo "Voici quelques informations concernant la taille du fichier avant réduction :\n";
      print_r($_FILES);

      echo '</pre>';

}

else{

  echo 'Veuillez entrez un fichier';
}

?>

</body>
</html>
