<?php
// The MAX_PATH below should point to the base of your OpenX installation
define('MAX_PATH',getcwd() . "/..");

if (@include_once(MAX_PATH . '/www/delivery/alocal.php')) {
@include_once(MAX_PATH . '/plugins/deliveryCacheStore/oxMemcached/oxMemcached.delivery.php'); 
@include_once(MAX_PATH . '/lib/max/Delivery/cache.php'); 
$mc=_oxMemcached_getMemcache();
$step=0;
if($mc==false){
header('HTTP/1.0 500 cannot create memcache', true, 500);
	echo "Cannot create memcache object";
	die;
}
else $step=1;
$_MemcacheTest=($mc->set("oxMemcacheTest","This is test",false,1));
if($_MemcacheTest==false){
header('HTTP/1.0 502 cannot insert to memcache', true, 502);
	echo "Cannot insert to memcache";

}}
else header('HTTP/1.0 500 Cannot include alocal.php',true,500);
echo OA_Delivery_Cache_buildFileName("fff");

?>

