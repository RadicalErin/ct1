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
# web directory
mkdir -p www
cd www
# lamp server
apt-get -y --force-yes install lamp-server^
# make sure we own the vagrant files in the shared folder
chown -R vagrant:vagrant .*
# set php time zone here
service apache2 restart
# install gui ... comment to disable
apt-get -y --force-yes install ubuntu-desktop
