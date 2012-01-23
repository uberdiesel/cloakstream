sudo apt-get update

### START CLOAKSTREAM CONFIG
#sudo apt-get --assume-yes install git-core
sudo apt-get --assume-yes install php5-sqlite

#git clone git://github.com/uberdiesel/cloakstream
#chown www-data cloakstream
chown www-data .

mkdir temp
cd temp

# mod_auth_token
wget http://mod-auth-token.googlecode.com/files/mod_auth_token-1.0.5.tar.gz
tar -xvf mod_auth_token-1.0.5.tar.gz
cd mod_auth_token-1.0.5
sudo apt-get --assume-yes install automake1.10
sudo apt-get --assume-yes install apache2-threaded-dev
./configure
make
sudo make install
cd ..

# mod_h264_streaming
wget http://h264.code-shop.com/download/apache_mod_h264_streaming-2.2.7.tar.gz
tar -zxvf apache_mod_h264_streaming-2.2.7.tar.gz
cd mod_h264_streaming-2.2.7
sudo apt-get --assume-yes install automake1.10
sudo apt-get --assume-yes install apache2-threaded-dev
./configure --with-apxs=`which apxs2`
make
sudo make install
echo "
LoadModule h264_streaming_module /usr/lib/apache2/modules/mod_h264_streaming.so
AddHandler h264-streaming.extensions .mp4
" >> /etc/apache2/httpd.conf
cd ..

# delete auth&h264 stuff
cd ..
rm -rf temp

#after modules are installed
sudo service apache2 restart

#sickbeard
#cd ~
#git clone git://github.com/midgetspy/Sick-Beard
#sudo apt-get --assume-yes install python python-cheetah
#cd Sick-Beard
#screen -dm -S SickBeard python SickBeard.py
#echo "Sickbeard has been installed in"
#pwd

