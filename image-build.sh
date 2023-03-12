#!/bin/bash
while getopts p: flag
do
    case "${flag}" in
        p) project_name=${OPTARG};;
    esac
done
#./image-build -p devops-rnd-328408
echo "docker buildx build --platform linux/amd64 --rm -t asia.gcr.io/${project_name}/php-apache:test ."
docker buildx build --platform linux/amd64 --rm -t asia.gcr.io/${project_name}/php-apache:test .