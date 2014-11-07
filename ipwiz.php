<?php

/** 
 * copyright Jonas Felix 2014 <jonas.felix@felixideas.ch>
 * add GPLv3 note...
 */

$lookup = $argv[1];
if(empty($lookup)) {
	echo "Usage: ipwiz <somedomain>\n";
	exit(1);
}

$mx = array();
$ns = array();
if(filter_var($lookup, FILTER_VALIDATE_IP)) {
	$ip = $lookup;
	$host = gethostbyaddr($ip);
} else {
	$ip = gethostbyname($lookup);
	$host = gethostbyaddr($ip);
	getmxrr($lookup, $mx);
	$ns = dns_get_record($lookup, DNS_NS);
}

echo 'looking up: '.$lookup."\n";
echo 'host: '.$host."\n";
echo 'ip: '.$ip."\n";
echo 'mx: ';
foreach($mx as $mxRecord) {
	echo $mxRecord.'('.gethostbyname($mxRecord).")\n";
}
echo 'ns: ';
foreach($ns as $nsRecord) {
	echo $nsRecord['target'].", ";
}
echo "\n";
