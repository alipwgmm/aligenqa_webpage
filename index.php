<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">

<SCRIPT TYPE="text/javascript">
             <!--
function lunchboxOpen(lunchID) {
    document.getElementById('lunch_' + lunchID).style.display = "block";
    document.getElementById('clasp_' + lunchID).innerHTML="<a href=\"javascript:lunchboxClose('" + lunchID + "');\">Viewing `" + lunchID + "' (close)</a>";
}

function lunchboxClose(lunchID) {
    document.getElementById('lunch_' + lunchID).style.display = "none";
    document.getElementById('clasp_' + lunchID).innerHTML="<a href=\"javascript:lunchboxOpen('" + lunchID + "');\">" + lunchID + "</a>";
}
//-->
</SCRIPT>
<?php
// get requests - use links to tell php at which systems we want to look
// general comment: for now this entire file is loosely typed, that should be fixed ...
$div = $_GET['div'];
$cat = $_GET['cat'];
$folder=$_GET['folder'];
?>

<title>AliGenQA - QA page for Monte Carlo generators used in ALICE</title>

<link rel="shortcut icon" href="ico.png" type="image/x-icon">
<link rel="icon" href="ico.jpg" type="image/x-icon">
<meta name="robots" content="follow">
<meta name="revisit-after" content="1 week">
<meta name="author" content="Redmer Alexander Bertens">


<!-- cascading style sheet. should be moved to independent css file, but for now it's here -->
<style type="text/css">

.clasp {
    text-align:left;
    border-top:1px solid #e0e0e0;
}
.lunchbox {
text-align:
    left;
display:
    none;
color:
#000000;
    padding:3px;
background-color:
#DCDCDC;
}
a {
color:
#000000;
text-decoration:
    none;
}
h1 {
    font-size:1.3em;
}
body {
    font-size:1.5em;
text-align:
    center;
background-color:
#FFFFFF;
font-family:
    Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
color:
#000000;
    margin:0px;
    padding:0px;

}
img {
    border:0px;
}
#mainContainer{


width:970px;
margin:0 auto;
text-align:
center;
background-color:
#FFFFFF;

color:
#000000;
}

#leftContainer{
width:160px;
float:
left;
padding-left:20px;
padding-right:5px;
height:50px;
text-align:
left;
background-color:
#FFFFFF;
color:
#000000;
}

#rightContainer{
width: 160px;
float:
right;
padding-left:5px;
padding-right:5px;
height:50px;
text-align:
left;
background-color:
#FFFFFF;
color:
#000000;
}

#contentContainer{

color:
#000000;
text-align:justify;
overflow:
auto;
width:550px;
background-color:
#FFFFFF;
padding-left:225px;
padding-right:15px;
}

img {
    border:0px;
}
</style>
</head>
<body>

<div id="mainContainer">
<hr>
<b>AliGenQA - QA page for Monte Carlo generators used in ALICE</b> 
<hr>
<div id="leftContainer">
<a href="http://aligenqa.web.cern.ch/aligenqa/" title="Click here to return to the main page">HOME</a> <br>
<hr>
Systems
<ul>
<li><a href="index.php?div=pp/">pp</a></li>
<li><a href="index.php?div=p-Pb/">p-Pb</a></li>
<li><a href="index.php?div=Pb-Pb/">Pb-Pb</a></li>
</ul>
<hr>
</div>

<div id="contentContainer">

<?php
$dirstring = $_GET['div'];
$req = $_GET['req'];

// let php process the get request
if($div!=NULL) {
    // for future scalability, check top level directory at this point
    $divplod = explode("/", $dirstring);
    $dirstring = "data/".$divplod[0]."/";
    // avoid diretory traversing by explicitely catching paths . and .. here
    if($divplod[0]==".." || $divplod[0]==".") echo "Nothing to see here ... ";
    else {
        // get directory handle
        if ($handle = opendir($dirstring)) {
            // read content from handle
            while (($file = readdir($handle))) {
                // again avoid traversing or viewing .htaccess 
                if ($file != "." && $file != ".." && $file != ".htaccess") {
                    // dont show raw root files
                    $fileinfo = pathinfo($file);
                    if ($fileinfo["extension"] == "root") continue;
                    $files[]=$file;
                }
            }
            // close the directory handle
            closedir($handle);
        }
        // sort alphabetically and count files
        sort($files);
        $count=count($files);
        // later on probably we should use reg expr to make prettier
        // folder names   
        $nodirstring = str_replace("_"," ",$divplod[0]);
        if($count == 0) echo "No info on this system yet";
        else {
            // if system is found, list contents
            echo $count;?> items for system '<?php echo $nodirstring ?>', click on the name to open<br>
<br>
<?php
        }
        // loop over content of folder from a specific system
        for($i=0; $i < $count+1; $i++) {
            $name = explode(".",$files[$i]);
            sort($name,SORT_STRING);    
            $noname = str_replace("_"," ",$name[0]);
?>
<!-- make unique containers here and toggle open and close with the small javascript -->
    <div id="clasp_<?php echo $name[0];?>" class="clasp"><a href="javascript:lunchboxOpen('<?php echo $name[0];?>');"><?php echo $noname;
?></a></div>
    <div id="lunch_<?php echo $name[0];?>" class="lunchbox">
<?php
            $folder = $dirstring.$files[$i]."/";
            // pass folder name to external script which generates the contents of the pop up table
            $dirfile='dir_beta.php';
            $string = $folder.$dirfile;
            include('dir_beta.php');
            echo "</div>";
        }
    }
}
?>
                                                                                    <?php
if(!$div&&!$req)
{
    include 'begin';
}
if($req=='about')
{
    include 'about';
}
if($req=='404/')
{
    echo "Oops ... you've encountered a broken link, or perhaps a file is missing ...";
}
?>
</div>
</div>
<br><br>
</body>
</html>
