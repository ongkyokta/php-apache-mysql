#!/bin/bash
while getopts p: flag
do
    case "${flag}" in
        p) project_name=${OPTARG};;
    esac
done
echo "docker buildx build --platform linux/amd64 --rm -t asia.gcr.io/${project_name}/php-apache:latest ."
docker buildx build --platform linux/amd64 --rm -t asia.gcr.io/${project_name}/php-apache:latest .