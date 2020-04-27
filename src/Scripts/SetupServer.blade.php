@extends('base')
@section('content')
# Wait For Apt To Unlock

while fuser /var/lib/dpkg/lock >/dev/null 2>&1 ; do
    echo "Waiting for other software managers to finish..."

    sleep 1
done

# Update & Install Packages

apt-get update
apt-get upgrade -y

apt-get install -y --force-yes build-essential \
                               curl \
                               wget \
                               zip \
                               unzip \
                               fail2ban \
                               ufw \
                               software-properties-common \
                               supervisor \
                               whois \
                               htop

# Disable Password Authentication Over SSH

sed -i "/PasswordAuthentication yes/d" /etc/ssh/sshd_config
echo "" | sudo tee -a /etc/ssh/sshd_config
echo "" | sudo tee -a /etc/ssh/sshd_config
echo "PasswordAuthentication no" | sudo tee -a /etc/ssh/sshd_config

# Set the timezone to UTC
sudo ln -sf /usr/share/zoneinfo/UTC /etc/localtime

@include('php.74')

@include('tools.nginx')

@include('tools.redis')

@endsection