<?php
/*
Script by: Aravind Kumar
www.arvizardanimations.com
This script is released under GNU General Public License v3
*/
$timeline="http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=JWHC_";
$xml= new SimpleXMLElement(file_get_contents($timeline));
$i=0;
print "<ul class=\"tweet_list\">";
foreach($xml ->children() as $tstatus)
	{
		$stat=$tstatus->text;
		$split= preg_split('/\s/',$stat);
		print "<li class=\"tweet\"><p class=\"tweet_text\">";
		foreach ($split as $word)
			{

				if (preg_match('/^@/',$word)) {
							   print " "."<a href=http://www.twitter.com/".substr($word,1).">".$word."</a>";
							   }
							   else if (preg_match('/^http:\/\//',$word)){
								     print " "."<a href=".$word.">".$word."</a>";
							   }
							   else
								   {
								   print " ".$word;
							   }

							   
			}
print "</p>";
print "<span class=\"date\">".substr($tstatus->created_at,0,strlen($tstatus->created_at)-14)."</span>";
print "</li>";
$i++;
if ($i==5)
	{
		
		break;
	}
	}
print "</ul>";
?>