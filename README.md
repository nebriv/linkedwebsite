LinkedIn Website Profile Updater
===========================

This will connect your website to LinkedIn's API and pull your profile information in multiple arrays. All you need to do it go to /update.php in order to pull the most recent information.

Do to the lack of time I won't be able to develop this much more, I just found this code on my server and figured I should throw it up for public viewing.

Setup
===========
Create a LinkedIn API key and secret by going here and signing up for the developer network:
https://www.linkedin.com/secure/developer

Edit settings.php to reflect your information and your new API key.

Vist your website/update.php and "login" using your password. You will then be asked to allow your website to access your LinkedIn profile via OAuth authentication. Once this happens a new XML file will be generated containing your profile information, which loadprofile.php will parse into various arrays.

For an example on displaying this information look at example.php




[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/nebriv/linkedwebsite/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

