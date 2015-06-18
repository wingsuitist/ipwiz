<?php

/** 
 * copyright Jonas Felix 2014 <jonas.felix@felixideas.ch>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


if(empty($argv[1])) {
	echo "Usage: ipwiz <somedomain>\n";
	exit(1);
}
$lookup = $argv[1];

$mx = array();
$ns = array();
if(filter_var($lookup, FILTER_VALIDATE_IP)) {
	$ip = $lookup;
	$host = gethostbyaddr($ip);
} else {
	$ip = gethostbyname($lookup);
	$host = gethostbyaddr($ip);
	
	$lookupParts = explode('.', $lookup);
	$partsCount = count($lookupParts);
	$position = $partsCount;
	do {
		$domain = implode('.', array_slice($lookupParts, $partsCount - $position));
		getmxrr($domain, $mx);
		$ns = dns_get_record($domain, DNS_NS);
		$position--;
	} while(empty($ns) && $position > 0); 
}

echo 'looking up: '.$lookup."\n";
echo 'host: '.$host."\n";
echo 'ip: '.$ip."\n";
echo 'domain: '.$domain."\n";
echo 'mx: ';
foreach($mx as $mxRecord) {
	echo $mxRecord.'('.gethostbyname($mxRecord).' ';
}
echo "\n";
echo 'ns: ';
foreach($ns as $nsRecord) {
	echo $nsRecord['target'].", ";
}
echo "\n";
