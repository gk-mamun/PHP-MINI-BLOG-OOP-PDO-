<?php require 'classes/Database.php'; ?>
<?php 

  $database = new Database;

  $id = $_GET['id'];


  // Update data
  if(isset($_POST['confirm-delete'])) {
    $database->query('DELETE FROM blog WHERE id = :id');
    $database->bind(':id', $id);
    $database->execute();
    if($database->execute()) {
      header("Location: index.php?delete=deleted");
    }
    
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Post</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section>
  <div class="delete-form">
      <h1>Are you confirm to delete the post?</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

          <a href="index.php" class="no-btn">NO</a>
          
          <button class="delete-btn" type="submit" name="confirm-delete">YES</button>
          
        </form>
      </div>
  </section>
</body>
</html>