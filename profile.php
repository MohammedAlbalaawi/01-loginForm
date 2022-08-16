<?php

session_start();
require_once "conn.php";

$urlId = $_GET['id'];
$id = $_SESSION['loginid'];

if($urlId === $id){
$dbData = mysqli_query($conn,"select * from users where id='$id'");

while ($row = mysqli_fetch_array($dbData)) {
    ?>
    <div>
        <label>Welcome : <?= $row['name'] ?></label><br>
        <label>Age : <?= $row['age'] ?></label><br>
        <label>Country : <?= $row['country'] ?> - <?= $row['city'] ?></label><br>
    </div>
<?php
}
}else{
    echo "You Don't have the permission to access this page!";
    header("refresh:2;url=profile.php?id=$id");
}
?>

<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
<a href="logout.php">LOGOUT</a>
</body>
</html>

