<?php 
//take varibles for vhost + www-data location from config
include 'config.php'; 
?>

<?php

//variables from form
$domain = $_POST['domain'];
$ssl = $_POST['ssl'];

//create www-data folder
if (!file_exists("$wwwData/$domain")) {
mkdir("$wwwData/$domain", 0777, true);
    
//add dummy index.html
$fp = fopen("$wwwData/$domain/" . "index" . '.html', "w+");
fwrite($fp,"It works!");
fclose($fp);
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

//did they say yes to ssl :)
if($ssl == "yes")
{
echo "Running Certbot...<br>";
exec ("sudo certbot --apache --non-interactive --agree-tos --redirect --register-unsafely-without-email -d $domain -d www.$domain 2>&1", $output, $return_var);
    
var_dump($return_var);
echo "return_var is: $return_var" . "\n";
var_dump($output);

echo "Reloading Apache...<br>";
exec ("sudo apache2ctl graceful");
echo "<a href=https://$domain>Click here to go to your site!</a>";
}

//or did they say no :(
else if($ssl == "no")
{
echo "Enabling VirtualHost...<br>";
exec ("sudo a2ensite $domain");
echo "Reloading Apache...<br>";
exec ("sudo apache2ctl graceful"); 
echo "<a href=http://$domain>Click here to go to your site!</a>";
}

?>
