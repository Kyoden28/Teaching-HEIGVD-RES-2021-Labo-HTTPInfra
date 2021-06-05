<?php	
	$ip_static = getenv('STATIC_APP');	
	$ip_dynamic = getenv('DYNAMIC_APP');	
	$ip_static2 = getenv('STATIC_APP2');	
	$ip_dynamic2 = getenv('DYNAMIC_APP2');	
?>
<VirtualHost *:80>

	ServerName labores.demo.ch
	
	<Proxy balancer://myclusterdynamic>
		BalancerMember 'http://<?php print "$ip_dynamic"?>'
		BalancerMember 'http://<?php print "$ip_dynamic2"?>'
	</Proxy>
	
	<Proxy balancer://myclusterstatic>
		BalancerMember 'http://<?php print "$ip_static"?>'
		BalancerMember 'http://<?php print "$ip_static2"?>'
	</Proxy>
	
	ProxyPass '/api/people/' 'balancer://myclusterdynamic/'
	ProxyPassReverse '/api/people/' 'balancer://myclusterdynamic/'
	
	ProxyPass '/' 'balancer://myclusterstatic/'
	ProxyPassReverse '/' 'balancer://myclusterstatic/'
	
</VirtualHost>


