<?php
// require "connection.php";
// // display all
//  $displayAll= mysqli_query($con, "SELECT * FROM `students`");
//  while (($result = mysqli_fetch_assoc($displayAll))){
//    echo '<hr>'; print_r($result);
//  }
//  mysqli_close($con);
//
// require "connection.php";
// // display just first names
// $displayPrenom= mysqli_query($con, "SELECT * FROM `students`");
// while (($result = mysqli_fetch_assoc($displayPrenom))){
//   echo '<hr>'; print_r($result['prenom']);
// }
//  mysqli_close($con);
 ?>

 <table border="2">
 <tr>
 <th>ID Student</th>
 <th>Nom</th>
 <th>Prenom</th>
 <th>Birthyear</th>
 <th>Genre</th>
 <th>Ecole</th>
 <th>Avatar</th>
 </tr>
 <?php
 include "connection.php";
 $select = $con->prepare("SELECT * FROM students ");
 $select->setFetchMode(PDO::FETCH_ASSOC);
 $select->execute();
 while($data=$select->fetch()){
 ?><tr>
 <td><?php echo $data['idstudent']; ?></td>
 <td><?php echo $data['nom']; ?></td>
 <td><?php echo $data['prenom']; ?></td>
 <td><?php echo $data['birthyear']; ?></td>
 <td><?php echo $data['genre']; ?></td>
 <td><?php echo $data['ecole']; ?></td>
 <td><img src="./images/<?php echo $data['avatar']; ?>" width="100" height="100"></td>
 <?php
 }?>
 </tr></table>
 <a href="index.php">Add new image</a>
