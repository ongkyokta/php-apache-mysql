#!/bin/bash
while getopts p: flag
do
    case "${flag}" in
        p) project_name=${OPTARG};;
    esac
done
#./image-push.sh -p devops-rnd-328408
echo "docker push asia.gcr.io/${project_name}/php-apache:test"
docker push asia.gcr.io/${project_name}/php-apache:test