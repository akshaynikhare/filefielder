<!DOCTYPE html>
<?php
require "Opration.php";
$op= new Opration();
$fname=$_REQUEST['fx'];
$name=$op->get_fname($fname);
$op->EXPC();
session_start();
if($_SESSION["id"]) {}
else
{
    header("Location:index.php");
}
$user=$_SESSION["id"];
if($_REQUEST['kp'])
{
    echo "verifing key........";
    $taskd=new Opration();
    $taskd->Download($fname, $_REQUEST['kp']);
}

if (isset($_POST['verify']))
{
    $key=$_POST['key'];
    $taskd=new Opration();
    $taskd->Download($fname, $key);
}
?>

<!---->
<br><br><br><br><br><br>
<html>
   <head>
       <title>jQuery File Upload Demo</title>
       <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" href="css/stylekey.css">
       <link href="css/home.css" rel="stylesheet">
   </head>
   <body>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">

            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">File Fielder</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll" >
                        <a href="#profile.php"><strong> <i class="glyphicon glyphicon-user"><?php echo $_SESSION["name"]." "?></i></strong></a>
                    </li>
                    <li class="page-scroll active">
                        <a href="home.php" >Download</a>
                    </li>
                    <li class="page-scroll">
                        <a href="upload.php">Upload</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about.php">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="logout.php">logout</a>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

    <div class="container " >
        <form class="form-signin" method="post" action="">
            <h3 class="form-signin-heading">Please provide key for  "<?php echo "".$name;?> "</h3>
            <br>
            <label for="inputEmail" class="sr-only">Key</label>
            <input type="text" name="key" class="form-control" placeholder="Key" required autofocus>
            <br>
            <input class="btn btn-lg btn-primary btn-block" type="submit"  name="verify" value="verify"/>
        </form>

    </div>

    </body>
</html>








