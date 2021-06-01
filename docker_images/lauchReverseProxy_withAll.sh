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
docker run -p 8080:80 res/reverse_proxy
