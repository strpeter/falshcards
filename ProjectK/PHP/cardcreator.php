<?php
//connect database
//include("dbinfo.inc.php");
//mysql_connect('localhost',$username,$password);
//mysql_select_db($database) or die( "Unable to select database");

//write into database
//$query = "INSERT INTO kartei VALUES ('',$VARIABLE_FILENAME,$VARIABLE_LECTURE,$VARIABLE_QUEST,$VARIABLE_ANSWER,$VARIABLE_SOURCE,$VARIABLE_DEVELOPER)";

$VARIABLE_LECTURE = 'bla';
$VARIABLE_SOURCE = 'bla';
$VARIABLE_DEVELOPER = 'peter';
$VARIABLE_QUEST = 'question';
$VARIABLE_ANSWER = 'answer';
$VARIABLE_FILENAME = 'test';

echo 'writing tex file
';
//create the card out of the dataset
exec('echo -e "\\\documentclass[
				% print,
				a6paper,
				% flip,
				% grid=rear
				]{kartei2}
\\\begin{document}
\\\cardsubject{'.$VARIABLE_LECTURE.'}
\\\comment{'.$VARIABLE_SOURCE.','.$VARIABLE_DEVELOPER.'}
\\\answer{Answer}
\\\begin{karte}{'.$VARIABLE_QUEST.'}
	'.$VARIABLE_ANSWER.'
\\\end{karte}
\\\end{document}" > '.$VARIABLE_FILENAME.'.tex');

echo 'compiling tex file
';
//typeset the card
exec('pdflatex '.$VARIABLE_FILENAME.'.tex');

//show the log file for error-messages (makes this sense?)
//echo VARIABLE_FILENAME.log;

//finish work on mysql
//mysql_close();
echo 'finished.';
?>
