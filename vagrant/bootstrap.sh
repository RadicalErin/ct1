sudo su
# symfony
curl -Ls https://symfony.com/installer -o /usr/local/bin/symfony
chmod a+x /usr/local/bin/symfony
# composer
curl -s https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
composer self-update
# web directory
mkdir -p www
cd www
# update the machine
apt-get update
# lamp server
apt-get install lamp-server^
# make sure we own the vagrant files in the shared folder
chown -R vagrant:vagrant .*
# set php time zone here
service apache2 restart

