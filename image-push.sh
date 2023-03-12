#!/bin/bash
while getopts p: flag
do
    case "${flag}" in
        p) project_name=${OPTARG};;
    esac
done
echo "docker push asia.gcr.io/${project_name}/php-apache:latest"
docker push asia.gcr.io/${project_name}/php-apache:latest