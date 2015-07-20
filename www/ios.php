[<?php

function arr_GetCotendoIp()
{
        if(empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
                return $_SERVER['REMOTE_ADDR'];
        }
        else
        {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
}


if(!isset($_GET["ctype"])) { header('Content-Type: text/x-javascript; charset=utf-8');}

$sErrors="";


//<!--/* OpenX Local Mode Tag v2.8.5 */-->
$ourint=0;


$ip=arr_GetCotendoIp();

if (strpos($ip,"95.86")||strpos($ip,"212.76")||strpos($ip,"213.151")||strpos($ip,"31.44")||strpos($ip,"37.60"))  $_REQUEST["rimon"]=1; 

// The MAX_PATH below should point to the base of your OpenX installation
define('MAX_PATH',str_replace("7/www","7/",getcwd()));
if (@include_once(MAX_PATH . '/www/delivery/alocal.php')) {

	$phpAds_context_banners = array();
	$phpAds_context_campaign = array();

	$z = explode (",", $_GET["z"]);
	if (!ereg('^[[:digit:]]+(,[[:digit:]]+)*$', $_GET["z"])) {
		die ("z must be a comma separated list of numbers");
	}
	
	for ($i = 0; $i <  count ($z); $i++)
	{
		$phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '', $phpAds_context_campaign, '');
		// re-try if needed
		if(empty($phpAds_raw["bannerid"])){echo("/*retry*/"); $phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '', $phpAds_context_campaign, '');}
		if(empty($phpAds_raw["bannerid"])){echo("/*retry no campaign*/"); $phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '', $phpAds_context_banners, '');}
		if(empty($phpAds_raw["bannerid"])) {echo("/*retry no banner*/"); $phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '0', array(), '');}



		$phpAds_context_banners[] = array('!=' => 'bannerid:'.$phpAds_raw['bannerid']);

		$phpAds_context_campaign[] = array('!=' => 'bannerid:'.$phpAds_raw['bannerid']);
		$phpAds_context_campaign[] = array('!=' => 'campaignid:'.$phpAds_raw['campaignid']);

		ourview2($i,0,$z[$i],$phpAds_raw);

	}
}
else {echo(";/*openX alocal.php not found*/");}
function ourview2($id,$divid,$zone,$phpAds_raw){
   if(!empty($phpAds_raw["bannerid"])){
	ourview($id,$divid,$phpAds_raw["aRow"]["zoneid"],
	$phpAds_raw["bannerid"],
	$phpAds_raw["campaignid"],
	$phpAds_raw["url"],
	$phpAds_raw["aRow"]["filename"],
	$phpAds_raw["aRow"]["contenttype"],
	$phpAds_raw["aRow"]["pluginversion"],
	$phpAds_raw["height"],
	$phpAds_raw["width"],
	$phpAds_raw["aRow"]["htmltemplate"],
	$phpAds_raw["aRow"]["append"],$phpAds_raw["aRow"]["alt"],"",
	$phpAds_raw["aRow"]["imageurl"],
	$phpAds_raw["aRow"]["block_ad"],$phpAds_raw["aRow"]["cap_ad"],$phpAds_raw["aRow"]["session_cap_ad"],
	$phpAds_raw["aRow"]["block_campaign"],$phpAds_raw["aRow"]["cap_campaign"],$phpAds_raw["aRow"]["session_cap_campaign"],
	$phpAds_raw["aRow"]["block_zone"],$phpAds_raw["aRow"]["cap_zone"],$phpAds_raw["aRow"]["session_cap_zone"],
	(!empty($phpAds_raw["aRow"]['viewwindow']) && !empty($phpAds_raw["aRow"]['tracker_status'])) ? '1' : '0'
	);
   }
   else
   {
	global $sErrors;
	echo  ($id>0?",":"")."null\n";
	$sErrors.= $id." אין פרסום: zone $zone\\n";
   }
}

function ourview($inc_id,$divid,$zone,$bid, $cid, $url, $file, $type, $ver, $height,
$width, $html,$append,$alt,$keyword,$imageurl,
$block_ad=0,$cap_ad=0,$session_cap_ad=0,
$block_campaign=0,$cap_campaign=0,$session_cap_campaign=0,
$block_zone=0,$cap_zone=0,$session_cap_zone=0,$last_view=0){

if($zone=="")return;
	if ($width==1&&$height==1)
	{
		$html=$append;$type="png";
	}

	$alt  = str_replace("\"", "'", $alt  );
	$alt  = str_replace("\n", " ", $alt  );
	$alt  = str_replace("\r", "", $alt  );


	echo "{banner: $bid ,campaign:$cid,zone: $zone,type:\"$type\", file: \"$file\", height: $height,width: $width }\n";

	$used .=",$bid";
	$ourint++;
}

?>
<? echo  $sErrors!=""?"Info.Warn('$sErrors');":"" ?>]
