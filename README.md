# PHP-VirtualHost-Form
A PHP form to automatically make a VirtualHost file with optional automatic Let's Encrypt support.

# Usage:
1. Edit the `config.php` file to your liking (currently set to apache2 defaults on Ubuntu).
2. Upload all three files to the same directory.
3. Ensure your DirectoryRoot + VirtualHost folder's are set to 777
4. Nagivigate to `form.html` on your website.
5. Done!

## To-Do
- SSL support via certbot
- CSS it up ;D
- Domain validation
- `a2ensite` when action is completed
- redirect to homepage when action is completed
