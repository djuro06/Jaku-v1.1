<?php 
include_once 'includes/config.php'; 
include_once 'includes/redirect_if_logged_out.php';

$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id=?');
$stmt->execute([$user_id]);
$users = $stmt->fetch();

if(!isset($users)){
    echo "Error. User doesn't exist.";
    return;
}

if(isset($_POST["street"], $_POST["city"], $_POST["country"], $_POST["postalcode"])){
    $stmt = $pdo->prepare('UPDATE users SET street=?, city=?, country=?, postalcode=? WHERE user_id=?');
    $stmt->execute([$_POST["street"], $_POST["city"], $_POST["country"], $_POST["postalcode"], $user_id]);

    header("location: profile.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'template/head.php';  ?>
</head>

<body>
    <?php include_once 'template/menu.php';  ?>
    <div class="container">

        <h1><?php echo $users["username"]; ?>'s profile</h1>
        <br><br>

        <div class="col-sm-4">
            <h3>Personal data</h3><br>
            <form method="post">
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" name="street" id="street" value= "<?php echo $users['street'] ?>">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" name="city" id="city" value="<?php echo $users['city'] ?>" >
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" name="country" id="country" value= "<?php echo $users['country'] ?>">
                </div>

                <div class="form-group">
                    <label for="name">Postal Code:</label>
                    <input type="text" class="form-control" name="postalcode" id="postalcode" value= "<?php echo $users['postalcode'] ?>">
                </div>

                
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
           

            
        </div>

    </div><!-- /.container -->

	<?php include_once 'template/scripts.php'; ?>

</body>
</html>