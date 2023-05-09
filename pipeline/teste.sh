#!/usr/bin/env bash


#ip_vagrant=$(ip addr show wlp2s0 | grep -Po 'inet \K[\d.]+')

#echo "hoje é $ip_vagrant"


#ssh vagrant@192.168.1.174 'VARIAVEL_SSH=$(ip addr show eth1 | grep -Po 'inet \K[\d.]+')

#ip addr show eth1 | grep -Po 'inet \K[\d.]+'

#ssh vagrant@192.168.1.174 "VARIAVEL_SSH=\$(ip addr show eth1 | grep -Po 'inet \K[\d.]+'); echo \$VARIAVEL_SSH"

ssh -t vagrant@192.168.1.174 "echo \"export SERVER_IP=\$(hostname -I | grep -o '192\.168\.[0-9]\+\.[0-9]\+')\" >> /home/vagrant/.bash_profile"



#ssh vagrant@192.168.1.174 'echo $VARIAVEL_SSH'





#ssh -T vagrant@192.168.1.174 << EOF
#    echo "A variável VARIAVEL_SSH é: $VARIAVEL_SSH"
#EOF

#echo $VARIAVEL_SSH