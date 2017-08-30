<?php
    //Session Start
    session_start();
    if(isset($_POST['name'])){
        if(isset($_SESSION['bookmark'])){
            $_SESSION['bookmark'][$_POST['name']]=$_POST['url'];
        }else{
            $_SESSION['bookmark'] = Array($_POST['name'] => $_POST['url']);
        }
    }
    if(isset($_GET['action']) && $_GET['action'] == 'clear'){
        session_unset(); 
        session_destroy(); 
        header("Location: index.php");
    }
    if(isset($_GET['action'])||$_GET['action'] == 'delete'){
        unset($_SESSION['bookmark'][$_GET['name']]);
        header("Loacation: index.php");
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://bootswatch.com/cyborg/bootstrap.min.css">
    
    <style>
        .color{
            color:white;
        }
    </style>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-default">
<div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Bookmarker</a>
  </div>
  <div id="navbar" class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php?action=clear">Clear All</a></li>
    </ul>
  </div><!--/.nav-collapse -->
</div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
            <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
                <label>Website Name:</label>
                <input type="text" class="form-control" name="name">
                <label>Website URL:</label>
                <input type="text" class="form-control" name="url">
                </div>
                <input type="submit" class="btn btn-default" value="Submit">
                </form>
            </div>
            <div class="col-md-5">
                <?php if(isset($_SESSION['bookmark'])) : ?>
                    <ul class="list-group">
                        <?php foreach($_SESSION['bookmark'] as $name=>$url):?>
                        <li class="list-group-item">
                            <a href="http://<?php echo $url; ?>"><?php echo $name;?></a><a class="color"href="index.php?action=delete&name=<?php echo $name;?>">[X]</a>
                        </li>
                        <?php endforeach; ?>
                    </ul>	

            <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
