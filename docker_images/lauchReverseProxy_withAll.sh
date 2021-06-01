#!/bin/bash

cd Static_HTTP_Server

./build_image_docker.sh
./run_docker.sh

cd ..
cd Dynamic_HTTP_Server

./build_image_docker.sh
./run_docker.sh

cd ..

cd Reverse_Proxy

docker build -t res/reverse_proxy .
docker run -d -e STATIC_APP=172.17.0.2:80 -e DYNAMIC_APP=172.17.0.3:3000 -p 8080:80 --name apache_reverseproxy res/reverse_proxy
