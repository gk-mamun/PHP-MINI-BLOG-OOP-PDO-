<?php require 'classes/Database.php'; ?>
<?php 

  $database = new Database;


  // Insert data
  if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $database->query('INSERT INTO blog (title, body) VALUES (:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->execute();
    if($database->lastInsertId()){
      echo '<p>Post Added</p>';
    }
    
  }

  
  $database->query('SELECT * FROM blog /* WHERE id=:id*/ ORDER BY id DESC');
  //$database->bind(':id', 2);
  $rows = $database->resultset();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP(OOP) Blog</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section id="navbar">
  <h1>PHP OOP MINI BLOG</h1>
</section>
<main>
  <div id="main-area">
  <div class="add-post-area">
    <div class="add-form">
      <h1>Add Post</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
            <label>Title</label><br>
            <input type="text" name="title" placeholder="Add Title" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label>Body</label><br>
            <textarea name="body"  class="form-control"></textarea>
          </div>
          <br>
          <button class="add-btn" type="submit" name="submit">Submit</button>
          
        </form>
      </div>
  </div>
  <div class="all-post-area">
    <h1>All Posts</h1>
      <div>
      <?php foreach($rows as $row) : ?>
        <div class="post">
          <h3><?php echo $row['title']; ?></h3>
          <p><?php echo $row['body']; ?></p>
          <div class="home-btns">
            <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>
</body>
</html>


