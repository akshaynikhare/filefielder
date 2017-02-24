<?php
require "Opration.php";
session_start();
if($_SESSION["id"]) {}
else
{
    header("Location:index.php");
}
$user=$_SESSION["id"];
$op= new Opration();
$fname=$_REQUEST['fx'];
$name=$op->get_fname($fname);
$op->EXPC();

$sql= new SQLopration();
$speed=$op->speadtest();
$sz=round(($sql->get_uname_size($fname))/1024,2);
$ext=round($sz/$speed,2);

?>



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
                    <a href="#" >file detail</a>
                </li>
                <li class="page-scroll ">
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
    <div class="form-signin" style="font-size: 18px" >
        <h3 class="form-signin-heading"><u>file detail  </u></h3>
               <table border="0" cellpadding="20" cellspacing="5" width="500" class="tblListForm">

                  <tr class="">
                    <td> Name:- </td>
                    <td> <?php echo " \t".$name." \t";?></td>
                  </tr>
            <tr class="">
                <td>  size:- </td>
                <td><?php echo " \t".$sz." \t";?>  Kb</td>
            </tr>
            <tr class="">
                <td> current connection speed:-  </td>
                <td><?php echo " \t".$speed." \t";?> Kbps</td>
            </tr>
            <tr class="">
                <td>estimated file download time:-  </td>
                <td><?php echo" \t".$ext." \t";?> Sec</td>
            </tr>

        </table>
    </div>

</div>

</body>
</html>













<!---



<div id="container" align="center"  class="center-block" style="position: relative">
<form action=""method="post">
    <input type="text" name="key"/>
    <input type="submit" name="verify" value="verify"/>
</form>
    <div class="container">
        <div class="row vdivide">
            <div class="col-sm-6 text-center"><h1>One</h1></div>
            <div class="col-sm-6 text-center"><h1>Two</h1></div>
        </div>
    </div>
</div>

-->
</body>
</html>
