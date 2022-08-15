<?php

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    require_once "conn.php";

    $name = test_data($_POST['txt_name']);
    $pass = test_data($_POST['txt_pass']);

    if(empty($_POST['txt_name']) || empty($_POST['txt_pass'])){
        echo "Username/Password Can't be empty!";

    }else{
        $dbData = mysqli_query($conn,"select * from users where name='$name' and password='$pass'");
        $id = '';

        while ($row = mysqli_fetch_array($dbData)) {
            $id = $row['id'];
        }

        header("location: profile.php?id=$id");
        //echo $dbData -> num_rows;;
    }

}

// Test Entered Data
function test_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <form class="form-fields"
          method="post"
          action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h3 style="text-align: center">Login</h3>
        <input class="form-input" type="text" name="txt_name" placeholder="Your name"><br>
        <input class="form-input" type="password" name="txt_pass" placeholder="Your password"><br>
        <button class="form-btn" type="submit" name="btn_submit">Login</button>
    </form>
</div>

</body>
</html>
