Portfolio
============
Be careful, templates used are : http://themeforest.net/item/bucket-admin-bootstrap-3-responsive-flat-dashboard/6642985
http://themeforest.net/item/resumex-html-multipurpose-one-page-portfolio/7184392

## Installation
### Download Portfolio
``` bash
$ git clone git@github.com:FlorianLepot/Portfolio.git
``` 
### Download Composer
``` bash
curl -sS https://getcomposer.org/installer | php
``` 
### Install project and assets
``` bash
php composer.phar install
php app/console d:d:c
php app/console d:s:c
php app/console d:f:l
php app/console assets:install
``` 
### Permissions
`app/cache`, `app/logs`, `app/files` and `web/media` need write permission

``` bash
mkdir app/files web/media
HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs app/files web/media
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs app/files web/media
``` 
