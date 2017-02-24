<?php
include "Opration.php";
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
<html lang="en">
<head>

    <title>jQuery File Upload Demo</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link href="css/home.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/bootstrap/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/jquery.fileupload.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/jquery.fileupload-ui.css">

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
                <li class="page-scroll">
                    <a href="home.php" >Download</a>
                </li>
                <li class="page-scroll active">
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
<br><br><br><br><br><br>

<div class="container">
    <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
        <div class="fileupload-buttonbar">
            <table class="table" >
                <tr >
                    <td width=322 valign=top>
                        <input type="radio" id="Temprory" name="Temprory" onchange="storageT()" >Temprory storage
                        <input type="radio" id="permanent" name="permanent" onchange="storageP()" checked>permanent storages
                    </td>
                    <td width=322 rowspan=3 valign=top >

                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                    </td>
                </tr>
                <tr >
                    <td valign=top id="tline" >
                        <div>days
                        <input type="number" name="day" id="day" placeholder="days "   value=0 onchange="tupdate()" disabled/>
                        </div>

                        <div> hours
                            <input type="number" name="hour" id="hour" placeholder="houres " value=0 onchange="tupdate()"  disabled/>
                        </div>
                        <div>minuts
                        <input type="number" name="mi" id="mi" placeholder="minutes" value=5 onchange="tupdate()"  disabled/>       </div>
                       </td>
                </tr>
                <tr >
                    <td width=322 valign=top >
                        <button type="submit" class="btn btn-primary start" >
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start upload</span>
                        </button>
                        <span class="fileupload-process"></span>
                        <div class="col-lg-5 fileupload-progress fade">
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                            </div>
                            <div class="progress-extended">&nbsp;</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Demo Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>The maximum file size for uploads in this project is <strong>20 MB</strong> (default file size can be unlimited).</li>
                <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage</li>
                <li>online live version is at <a href="http://#">selfdistruct.appspot.com</a>.</li>
            </ul>
        </div>
    </div>


</div>
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
                  <p class="name">{%=file.name%}</p>
                  <br>
                  <p class="xtime"></p>
                  <input type="hidden" class="days1" name="days1" id="days1" value="0" />
                  <input type="hidden" class="hours1" name="hours1"  id="hours1" value="0"/>
                  <input type="hidden" class="min1" name="min1"  id="min1" value="0"/>
                  <input type="hidden" class="mode1" name="mode1"  id="mode1" value="P">

        </td>
        <td>
            {% if (!i && !o.options.autoUpload){ %}
                <button class="btn btn-primary start" disabled  style="display: none">
                    <i class="glyphicon glyphicon-upload"></i>
               </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script id="template-download" type="text/x-tmpl">
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/blueimp/tmpl.min.js"></script>
<script src="vendor/blueimp/load-image.all.min.js"></script>
<script src="vendor/blueimp/canvas-to-blob.min.js"></script>
<script src="vendor/blueimp/jquery.blueimp-gallery.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>
<script src="js/jquery.fileupload-ui.js"></script>
<script src="js/main.js"></script>
</body>
</html>
