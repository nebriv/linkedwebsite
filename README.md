LinkedIn Website Profile Updater
===========================

Create a LinkedIn API key and secret by going here and signing up for the developer network:
https://www.linkedin.com/secure/developer

Edit settings.php to reflect your information and your new API key.

Vist your website/update.php and "login" using your password. You will then be asked to allow your website to access your LinkedIn profile via OAuth authentication. Once this happens a new XML file will be generated containing your profile information, which loadprofile.php will parse into various arrays.

For an example on displaying this information look at example.php
