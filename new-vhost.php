<?php 
//take varibles for vhost + www-data location from config
include 'config.php'; 
?>

<?php

//variables from form
$domain = $_POST['domain'];
    
//create www-data folder
if (!file_exists("$wwwData/$domain")) {
    mkdir("$wwwData/$domain", 0777, true);
}

//create + write to vhost file
$fp = fopen("$sitesAvailable" . "$domain" . '.conf', "w+");
fwrite($fp, 
       
"<VirtualHost *:80>\n
	ServerName $domain
	ServerAlias www.$domain\n
	ServerAdmin webmaster@$domain
	DocumentRoot /var/www/html/$domain\n
	ErrorLog \${APACHE_LOG_DIR}/error.log
	CustomLog \${APACHE_LOG_DIR}/access.log combined\n
</VirtualHost>");

fclose($fp);
    
?>