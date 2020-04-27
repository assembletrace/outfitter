# Add repositories to get latest stable versions
# "development" is Nginx's MAINELINE branch & is actually considered stable
sudo add-apt-repository -y ppa:nginx/development

# Update local cache to learn about new available packages
sudo apt-get update

# Install Nginx
sudo apt-get install -y nginx