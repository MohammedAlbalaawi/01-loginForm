<?php
require_once 'conn.php';

$id = $_GET['id'];
$dbData = mysqli_query($conn, "select * from users where id='$id'");

while ($row = mysqli_fetch_array($dbData)) {
    ?>
    <div>
        <label>Welcome : <?= $row['name'] ?></label><br>
        <label>Age : <?= $row['age'] ?></label><br>
        <label>Country : <?= $row['country'] ?> - <?= $row['city'] ?></label><br>
    </div>
<?php
}
?>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
<a href="logout.php">LOGOUT</a>
</body>
</html>

