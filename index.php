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
$div = $_GET['div'];
$cat = $_GET['cat'];
?>


<?php
$folder=$_GET['folder'];
?>

<title>AliGenQA - QA page for Monte Carlo generators used in ALICE</title>

<link rel="shortcut icon" href="ico.png" type="image/x-icon">
<link rel="icon" href="ico.jpg" type="image/x-icon">
<meta name="robots" content="follow">
<meta name="revisit-after" content="1 week">
<meta name="author" content="Redmer Alexander Bertens">


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
<a href="http://against-the-day.com" title="Click here to return to the main page">HOME</a> <br>
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
if($div!=NULL)
{
    $divplod = explode("/", $dirstring);
    $dirstring = $divplod[0]."/";
    if($divplod[1]=="..")
    {
        echo "Nothing to see here";
    }
    else{
        if ($handle = opendir($dirstring)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != ".htaccess") {
                    //   echo "$file<br>";
                    $files[]=$file;        
                }
            }
            closedir($handle);
        }
        sort($files);
        $count=count($files)+1;
        $nodirstring = str_replace("_"," ",$divplod[0]);
?>

<?php 
        if(($count-2)<1)
        {
            echo "No info on this system yet";
        }
        else
        {
    echo $count-2;?> items for system '<?php echo $nodirstring ?>', click on the name to open<br>
<br>
<?php
        }
        for($i==0;$i<$count;$i++)
        {
            $name = explode(".",$files[$i]);
            sort($name,SORT_STRING);    
            $noname = str_replace("_"," ",$name[0]);
?>
    <div id="clasp_<?php echo $name[0];?>" class="clasp"><a href="javascript:lunchboxOpen('<?php echo $name[0];?>');"><?php echo $noname;
?></a></div>
    <div id="lunch_<?php echo $name[0];?>" class="lunchbox">


<?php
            $folder = $dirstring.$files[$i]."/";

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
