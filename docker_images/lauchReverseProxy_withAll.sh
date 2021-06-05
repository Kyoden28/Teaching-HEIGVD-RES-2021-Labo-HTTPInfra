#!/bin/bash

cd Static_HTTP_Server

./build_image_docker.sh
./run_docker.sh

docker build --tag  res/static_http_server2 .
docker run -d --name apache_static2 res/static_http_server2

cd ..
cd Dynamic_HTTP_Server

./build_image_docker.sh
./run_docker.sh

docker build --tag  res/dynamic_http_server2 .
docker run -d --name express_dynamic2 res/dynamic_http_server2

cd ..

cd Reverse_Proxy

docker build -t res/reverse_proxy .
docker run -d -e STATIC_APP=172.17.0.2:80 -e STATIC_APP2=172.17.0.3:80 -e DYNAMIC_APP=172.17.0.4:3000 -e DYNAMIC_APP2=172.17.0.5:3000 -p 8080:80 --name apache_reverseproxy res/reverse_proxy
