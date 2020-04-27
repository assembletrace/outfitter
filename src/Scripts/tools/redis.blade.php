# Install Redis
sudo apt-add-repository -y ppa:chris-lea/redis-server
sudo apt-get update

sudo apt-get install -y redis-server
sed -i 's/bind 127.0.0.1/bind 0.0.0.0/' /etc/redis/redis.conf
service redis-server restart