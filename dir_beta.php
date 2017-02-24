<?php
// open this directory

$summary = "summary.pdf";
$summary = $folder.$summary;
$figures = "figures";
$figures = $folder.$figures;

$myDirectory = opendir($figures);
// get each entry
while($entryName = readdir($myDirectory)) {
        $fileName[] = $entryName;
	$dirArray[] = $folder.$entryName;
}

// close directory
closedir($myDirectory);

//	count elements in array
$indexCount	= count($dirArray);
$hiddencount = $indexCount -2;
if($hiddencount==-2)
{
Print("There seems to be a problem listing the directory. ");
}
else
{
sort($dirArray);
sort($fileName);
print("<TABLE width=500 frame=void>\n");
    print("<TR><TD><a target=blank title='Click to open $fileName[$index] in a new window or tab' href=\"$summary\">View QA summary slides (.pdf)</a></td>");
print("<TR><TD><a target=blank title='Or browse all files' href=\"$figures\">Browse all QA files</a></td>");
print("</TABLE>\n");


}
unset($fileName);
unset($dirArray);
?>
