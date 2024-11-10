#! /bin/bash
if [ $# -eq 0 ]
  then
    dfile="docker-compose"
else
    dfile=$1
fi

docker rm -f $(docker ps -a -q)
docker-compose -f $dfile.yml up
