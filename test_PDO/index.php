<?php // connect to the server and database
include "connection.php";
// ∕∕create variables
if(isset($_POST['submit'])) {
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$birthyear= $_POST['birthyear'];
$genre= $_POST['genre'];
$ecole=$_POST['ecole'];
$avatar=$_FILES['avatar']['name'];
$folder="./images/";
$path = $folder . $avatar ;
$target=$folder.basename($_FILES['avatar']['name']);
$imageFileType=pathinfo($target,PATHINFO_EXTENSION);
$allowed=array('jpeg','png' ,'jpg');
$ext=pathinfo($avatar, PATHINFO_EXTENSION);
// ∕∕test
if(!in_array($ext,$allowed) )
{
 echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
}
else{
copy( $_FILES['avatar'] ['tmp_name'], $path);
$request="INSERT INTO students (nom,prenom,birthyear,genre,ecole,avatar)
 VALUES ( :nom, :prenom, :birthyear, :genre, :ecole, :avatar)";
$sth=$con->prepare($request);
$sth->bindParam(":nom", $nom);
$sth->bindParam(":prenom", $prenom);
$sth->bindParam(":birthyear", $birthyear);
$sth->bindParam(":genre", $genre);
$sth->bindParam(":ecole", $ecole);
$sth->bindParam(':avatar',$avatar);

// $sth->execute();
$success=$sth->execute();
  if ($success == TRUE) {
    echo "<hr> Thank you, your info now in my database";
  } else { echo "<hr> There was an error";
    die();
  }
  $sth->closeCursor();
  //everytime close the request, to prepare for new request
}
}

  ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>BeCode students</title>
</head>
<body>
  <h2>Are you a student Of Becode?</h2>
  <p>Add your info to my database, just for fun :)</p>
  <form enctype="multipart/form-data" action="" method="POST">
    <input type="text" name="nom" placeholder="Second name"><br>
    <input type="text" name="prenom" placeholder="First name"><br>
    <input type="text" name="birthyear" placeholder="Birth Year">
    <p>Gender? <br>
      <input type="radio" name="genre" value="M"> Male
      <input type="radio" name="genre" value="F"> Female</p>
    <input list="School" name="ecole" placeholder="School">
    <datalist id="School">
    <option value="Central">
    <option value="Charleroi">
  </datalist>
  <p>Add your avatar</p>
  <p><input type="file" name="avatar" value=""></p>
  <p><input type="submit" name="submit" value="Add member"></p>
  </form>
  <a href="action.php">See My DataBase</a>
</body>

</html>
