<?php

if(!isset($_GET["ctype"])) { header('Content-Type: text/x-javascript; charset=utf-8');}

//<!--/* OpenX Local Mode Tag v2.8.5 */-->
$ourint=0;

$ip=$_SERVER['REMOTE_ADDR'];

if (strpos($ip,"95.86")||strpos($ip,"212.76 ")||strpos($ip,"213.151"))  $_REQUEST["rimon"]=1; 

$divid=isset($_GET["div"])?$_GET["div"]:'';
// The MAX_PATH below should point to the base of your OpenX installation
define('MAX_PATH',str_replace("7/www","7/",getcwd()));
if (@include_once(MAX_PATH . '/www/delivery/alocal.php')) {

	$phpAds_context = array();

	$z = explode (",", $_GET["z"]);
	if (!ereg('^[[:digit:]]+(,[[:digit:]]+)*$', $_GET["z"])) {
		die ("z must be a comma separated list of numbers");
	}

	

	for ($i = 0; $i <  count ($z); $i++)
	{
		// function view_local($what, $zoneid=0, $campaignid=0, $bannerid=0, $target='', $source='', $withtext='', $context='', $charset='')
		$phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '0', $phpAds_context, '');
		// re- try if needed
		if(empty($phpAds_raw["bannerid"])) {echo("/*retry*/"); $phpAds_raw = view_local('', $z[$i], 0, 0, '', '', '0', $phpAds_context, '');}
		$phpAds_context[] = array('!=' => 'bannerid:'.$phpAds_raw['bannerid']);
		if(!isset($_GET["filter-campaign"])) $phpAds_context[] = array('!=' => 'campaignid:'.$phpAds_raw['campaignid']);
		ourview2($i,$divid,$z[$i],$phpAds_raw);

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
	$divid2=$divid==""?"Info.aIDs[$id].id":"'".$divid."'";
	echo "Info.aNoAds.push('$id. אין פרסום: zone $zone in '+".$divid2.");\n";
	if ($divid!="") echo("Info.Warn();");
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
	if ($type=="html"||$type=="") {
		$html = str_replace("\"", "'", $html);
		$html = str_replace("\n", " ", $html);
		$html = str_replace("\r", "", $html);
				
		// החלפת ביטויים מוכנים בתוך הHTML
		$search = array('{timestamp}','{random}','{target}','{url_prefix}','{bannerid}','{zoneid}','{source}', '{pageurl}', '{width}', '{height}', '{websiteid}', '{campaignid}', '{advertiserid}', '{referer}');
		$locReplace = isset($GLOBALS['loc']) ? $GLOBALS['loc'] : '';
		$websiteid = (!empty($aBanner['affiliate_id'])) ? $aBanner['affiliate_id'] : '0';
		$replace = array($time, $random, $target, $urlPrefix, $aBanner['ad_id'], $zoneId, $source, urlencode($locReplace), $aBanner['width'], $aBanner['height'], $websiteid, $aBanner['campaign_id'], $aBanner['client_id'], $referer);

		preg_match_all('#{(.*?)(_enc)?}#', $code, $macros);
		for ($i=0;$i<count($macros[1]);$i++) {
			if (!in_array($macros[0][$i], $search) && isset($_REQUEST[$macros[1][$i]])) {
				$search[] = $macros[0][$i];
				$replace[] = (!empty($macros[2][$i])) ? urlencode(stripslashes($_REQUEST[$macros[1][$i]])) : stripslashes($_REQUEST[$macros[1][$i]]);
			}
		}
		
		$code = str_replace($search, $replace, $code);
		
		if($divid!="")
			echo "Info.One('$divid',Info.Object($bid,$cid,$zone,\"html\",\"$url\",\"$html\",$ver,$height,$width,\"$append\",\"$alt\"),$block_ad, $cap_ad,$session_cap_ad,$block_campaign, $cap_campaign,$session_cap_campaign,$block_zone, $cap_zone,$session_cap_zone,$last_view);\n";
		else
			echo "Info.Insert($inc_id,Info.Object($bid,$cid,$zone,\"html\",\"$url\",\"$html\",$ver,$height,$width,\"$append\",\"$alt\"),$block_ad, $cap_ad,$session_cap_ad,$block_campaign, $cap_campaign,$session_cap_campaign,$block_zone, $cap_zone,$session_cap_zone,$last_view);\n";
	}
	else if(strpos($keyword,'flash') !== false){
		echo "Info.Flash($bid,$cid,$zone,'$url','$keyword',$ver,'$imageurl',$height,$width,$block_ad, $cap_ad,$session_cap_ad,$block_campaign, $cap_campaign,$session_cap_campaign,$block_zone, $cap_zone,$session_cap_zone,$last_view);\n";
	}
	else if($divid!="")
		echo "Info.One('$divid',Info.Object($bid,$cid,$zone,\"$type\",\"$url\",\"$file\",$ver,$height,$width,\"$append\",\"$alt\"),$block_ad, $cap_ad,$session_cap_ad,$block_campaign, $cap_campaign,$session_cap_campaign,$block_zone, $cap_zone,$session_cap_zone,$last_view);\n";
	else
		echo "Info.Insert($inc_id,Info.Object($bid,$cid,$zone,\"$type\",\"$url\",\"$file\",$ver,$height,$width,\"$append\",\"$alt\"),$block_ad, $cap_ad,$session_cap_ad,$block_campaign, $cap_campaign,$session_cap_campaign,$block_zone, $cap_zone,$session_cap_zone,$last_view);\n";

	$used .=",$bid";
	$ourint++;
}

if ($divid=='') {
?>
 Info.Log(); <?php } ?>