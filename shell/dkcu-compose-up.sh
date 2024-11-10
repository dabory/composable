#! /bin/bash
if [ $# -eq 0 ]
  then
    dfile="docker-compose"
else
    dfile=$1
fi

docker-compose -f $dfile.yml up
