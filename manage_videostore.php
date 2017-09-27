<?php 

include_once 'includes/config.php'; 
include_once 'includes/redirect_non_admin.php';

$stmt = $pdo->prepare('SELECT * FROM videostore');
$stmt->execute();
$videostoreData = $stmt->fetchAll();

if(isset($_POST["video_id"])){
    $stmt = $pdo->prepare('UPDATE videostore SET active=NOT(active) WHERE videostorevideo_id=?');
    $stmt->execute([$_POST["video_id"]]);

    echo "ok";
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0; $i<count($videostoreData); $i++){ ?>
                    <tr>
                        <td><?php echo $videostoreData[$i]["title"]; ?></td>
                        <td><?php echo $videostoreData[$i]["active"]; ?></td>
                        <td><button data-videoid="<?php echo $videostoreData[$i]['videostorevideo_id']; ?>" class="btn btn-info" onclick="changeStatus(this.getAttribute('data-videoid'))">Change status</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        
        
	</div>
	<?php include_once 'template/scripts.php'; ?>

  </body>
</html>

<script>
    function changeStatus(id){
        $.ajax({
            url: "manage_videostore.php",
            type: "post", //send it through get method
            data: { 
                video_id: id
            },
            success: function(response) {
                location.reload()

            },
            error: function(xhr) {
                alert("Something went wrong.");
            }
        });
    }
</script>