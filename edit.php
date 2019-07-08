<?php require 'classes/Database.php'; ?>
<?php 

  $database = new Database;

  $id = $_GET['id'];

  $database->query('SELECT * FROM blog  WHERE id=:id');
  $database->bind(':id', $id);

  $row = $database->singleresult();

  // Update data
  if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $database->query('UPDATE blog SET title = :title, body = :body WHERE id = :id');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->bind(':id', $id);
    $database->execute();
    if($database->execute()){
      header("Location: index.php?update=success");
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
  <div class="edit-form">
      <h1>Update Post</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
            <label>Title</label><br>
            <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label>Body</label><br>
            <textarea name="body"  class="form-control"><?php echo $row['body']; ?></textarea>
          </div>
          <br>
          <button class="update-btn" type="submit" name="update">Update</button>
          
        </form>
      </div>
  </section>
</body>
</html>