<?php
// start new session
session_start();

$msgErr = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once "conn.php";

    $name = test_data($_POST['txt_name']);
    $pass = test_data($_POST['txt_pass']);

    if (empty($_POST['txt_name']) || empty($_POST['txt_pass'])) {
        $msgErr = "Username/Password Can't be empty!";

    } else {
        // Get the hashed password to compaire
        $getPassword = mysqli_query($conn, "select password from users where name='$name'");

        $hashedPassword = '';
        while ($row = mysqli_fetch_array($getPassword)) {
            $hashedPassword = $row['password'];
        }

        // check if the entered password = the hashed  password
        if (password_verify($pass, $hashedPassword)) {

            $dbData = mysqli_query($conn, "select * from users where name='$name' and password='$hashedPassword'");
            $id = '';


            while ($row = mysqli_fetch_array($dbData)) {
                $id = $row['id'];
                // set session variables
                $_SESSION['loginuser'] = $row['name'];
                $_SESSION['loginid'] = $row['id'];
            }

            header("location: profile.php?id=$id");
            //echo $dbData -> num_rows;;
        } else {
            $msgErr = "WRONG Username/Password!";
        }
    }

}

// Test Entered Data
function test_data($data)
{
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
<?php
if (!isset($_SESSION['loginuser'])) {

    ?>
    <div class="form-container">
        <form class="form-fields"
              method="post"
              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3 style="text-align: center">Login</h3>
            <!--    Error Message    -->
            <h5 style="color: red; text-align: center;"><?= $msgErr; ?></h5>
            <input class="form-input" type="text" name="txt_name" placeholder="Your name"><br>
            <input class="form-input" type="password" name="txt_pass" placeholder="Your password"><br>
            <button class="form-btn" type="submit" name="btn_submit">Login</button>
        </form>
    </div>
<?php } else {
    echo "You Are Loged in : " . $_SESSION['loginuser'];
    echo "You will be redirected to home page within 3 sec";
    $newId = $_SESSION['loginid'];
    header("refresh:3;url=profile.php?id=$newId");
} ?>
</body>
</html>
