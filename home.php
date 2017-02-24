<br><br><br><br><br><br>

<?php
require "Opration.php";
$op= new Opration();
$op->EXPC();
session_start();
if($_SESSION["id"]) {}
else
{
    header("Location:index.php");
}
$user=$_SESSION["id"];
?>

<!DOCTYPE HTML>

<html lang="en">
<head>


<title>jQuery File Upload Demo</title>
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<link href="css/home.css" rel="stylesheet">


</head>
<body>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top">File Fielder</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll" >
                    <a href="#profile.php"><strong> <i class="glyphicon glyphicon-user"><?php echo $_SESSION["name"]." "?></i></strong></a>
                </li>
                <li class="page-scroll active">
                    <a href="#" >Download</a>
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
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>


<!-- download container -->
<div class="container" >
    <?php
        $con = dbcon("ecloud");
        $select = mysqli_query($con, "select * from file where user_id='$user' order by id desc");
        $num_row  = mysqli_num_rows($select);
        if($num_row<=0) {
            echo "OOps!!!   please upload file first...";
        }elseif($num_row>0) {
     ?>
           <div class="row" id="temp" style="background-color: #1ad3b0;"><h4 style="color: snow;padding-left: 3%"><u>Temperory files</u> </h4>
            <table role="presentation" class="table table-striped" >
        <thead style="background-color: rgb(223,227,221)" ><tr class="template-download fade in" >
            <td>
                <p class="name">
                    <strong>file name</strong>
                </p>
            </td>
            <td>
                <strong>size</strong>
            </td>
            <td>
                <strong>upload timestamp   /   expiry timestamp</strong>
            </td>
            <td>

            </td>
            <td>

            </td>
        </tr>
        </thead>
        <tbody >

            <?php
            while ($row1 = mysqli_fetch_array($select)) {

                if ($row1['mode'] == 'T') {
                    ?>
                    <tr class="template-download fade in">
                    </td>
                    <td>
                        <p class="name"> <?php echo "  " .$row1['fname']. "   "; ?>   </p>
                    </td>
                    <td>
                        <?php echo "  " . $row1['size'] . "    "; ?>
                    </td>
                    <td>
                        <?php echo "  " . $row1['date'] . "    "; ?><?php echo "  " . $row1['time'] . "    "; ?><strong>/</strong><?php echo "  " . $row1['exp_date'] . "    "; ?><?php echo "  " . $row1['exp_time'] . "    "; ?>
                    </td>
                    <?php
                    if ($row1['flag'] == '1') {
                        ?>
                        <td>
                            <a href="MAIN.php?fx=<?php echo $row1['uname']; ?>&kp=">
                                <button class="btn ">
                                    <i class="glyphicon glyphicon-download"></i>
                                    <span><strong>Download</strong></span>
                                </button>
                            </a>

                        </td>
                        <td>
                            <a href="f_tail.php?fx=<?php echo $row1['uname']; ?>">
                                <button class="btn ">
                                    <i class="glyphicon glyphicon-apple"></i>
                                    <span><strong>Detail</strong></span>
                                </button>
                            </a>
                        </td>
                        <?php
                    }else
                    {
                        ?>
                        <td>
                            <strong style="color: #c9302c"> file expired ! and deleated !!!</strong>
                        </td>
                        <?php
                    }
                        ?>


                    </tr>
                <?php }
            }
            ?>
        </tbody></table>
            </div>

            <div class="row"  id="perm" style="background-color: #1ad3b0"><h4 style="color: snow;padding-left: 3%"><u>Permanent files</u> </h4>
            <table role="presentation" class="table table-striped">
                <thead style="background-color: rgb(223,227,221)" ><tr class="template-download fade in" >
                    <td>
                        <p class="name">
                            <strong>file name</strong>
                        </p>
                    </td>
                    <td>
                        <strong>size</strong>
                    </td>
                    <td>
                        <strong>upload timestamp </strong>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
                </thead>
                <tbody >

                <?php
                $select = mysqli_query($con, "select * from file where user_id='$user' order by id desc");
                while ($row2 = mysqli_fetch_array($select)) {

                    if ($row2['mode'] == 'P') {
                        ?>
                        <tr class="template-download fade in">
                            </td>
                            <td>
                                <p class="name"> <?php echo "  " . $row2['fname'] . "   "; ?>   </p>
                            </td>
                            <td>
                                <?php echo "  " . $row2['size'] . "    "; ?>
                            </td>
                            <td>
                                <?php echo "  " . $row2['date'] . "    "; ?><?php echo "  " . $row2['time'] . "    "; ?>
                            </td>
                            <td>
                                <a href="MAIN.php?fx=<?php echo $row2['uname']; ?>&kp=">
                                    <button class="btn ">
                                        <i class="glyphicon glyphicon-download"></i>
                                        <span><strong>Download</strong></span>
                                    </button>
                                </a>

                            </td>
                            <td>
                                <a href="f_tail.php?fx=<?php echo $row2['uname']; ?>">
                                    <button class="btn ">
                                        <i class="glyphicon glyphicon-apple"></i>
                                        <span><strong>Detail</strong></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
                </tbody></table>
            </div>
     <?php
       }
     ?>

</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
