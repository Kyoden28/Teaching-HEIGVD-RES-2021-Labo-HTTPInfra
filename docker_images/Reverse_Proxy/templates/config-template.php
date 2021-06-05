<?php	
	$ip_static = getenv('STATIC_APP');	
	$ip_dynamic = getenv('STATIC_APP');	
?>
<VirtualHost *:80>
	ServerName labores.demo.ch
	
	ProxyPass '/api/people/' 'http://<?php print "$ip_dynamic"?>/'
	ProxyPassReverse '/api/people/' 'http://<?php print "$ip_dynamic"?>/'
	
	ProxyPass '/' 'http://<?php print "$ip_static"?>/'
	ProxyPassReverse '/' 'http://<?php print "$ip_static"?>/'
	
</VirtualHost>


