sudo su
# update the machine
apt-get update
# composer
composer self-update
# make sure we own the vagrant files in the shared folder
cd www
chown -R vagrant:vagrant .*
