<?php

// TODO should not be loosely typed, fixing is on the agenda

// define some useful variables
$summary = "summary.pdf";
$summary = $folder.$summary;
$figures = "figures";
$figures = $folder.$figures;

// open the folder
$myDirectory = opendir($folder);
// loop over folder contents
while($entryName = readdir($myDirectory)) {
        $fileName[] = $entryName;
	$dirArray[] = $folder.$entryName;
}
// close directory
closedir($myDirectory);

// count elements in array
$indexCount = count($dirArray);
if($indexCount == 0) print("No content, contact the conveners please");
else {
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
