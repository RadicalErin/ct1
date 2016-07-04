sudo su
# symfony
if ! hash symfony 2>/dev/null; then
    curl -Ls https://symfony.com/installer -o /usr/local/bin/symfony
    chmod a+x /usr/local/bin/symfony
fi
# composer
if ! hash composer 2>/dev/null; then
    curl -s https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
fi
composer require symfony/assetic-bundle
composer update nothing
composer install
# web directory
mkdir -p www
cd www
# lamp server
apt-get -y --force-yes install lamp-server^
apt-get install php5-curl
# make sure we own the vagrant files in the shared folder
chown -R vagrant:vagrant .*
# set php time zone here
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
service apache2 restart
# install gui ... comment to disable
apt-get -y --force-yes install ubuntu-desktop
