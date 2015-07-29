# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

$install_httpd = <<SCRIPT
yum install -y httpd mysql php php-mysql php-mbstring
rm -f /etc/httpd/conf.d/welcome.conf
rm -f /var/www/error/noindex.html
rm -r /var/www/html
mv /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.bck
ln -s /vagrant/httpd.conf /etc/httpd/conf/httpd.conf
ln -s /vagrant/html /var/www/html
chown -R apache:apache /var/www
service httpd start
chkconfig httpd on
SCRIPT

$install_mysqld = <<SCRIPT
yum install -y http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm
yum install -y mysql-community-server
service mysqld start
/vagrant/mysql_secure_installation.sh
chkconfig mysqld on
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "chef/centos-6.6"

  config.vm.box_url = "https://atlas.hashicorp.com/chef/boxes/centos-6.6/versions/1.0.0/providers/virtualbox.box"

  config.vm.define "web" do |web|
    web.vm.hostname = "web"
    web.vm.network :private_network, ip: "192.168.33.10"
    web.vm.provision :shell, inline: $install_httpd
  end

  config.vm.define "db" do |db|
    db.vm.hostname = "db"
    db.vm.network :private_network, ip: "192.168.33.11"
    db.vm.provision :shell, inline: $install_mysqld
  end

#  config.pushover.set do |p|
#    p.user  = "uYSMSM3aJG8usgi9dFh8BiGwTefVyx"
#    p.token = "asfvqjrM4ykKvLLqNzJZ5Z3W1QMqyW"
#  end
end
