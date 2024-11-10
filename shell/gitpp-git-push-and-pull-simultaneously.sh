#!/bin/bash
#git reset –hard

git config credential.helper store
git pull origin master

git add .
git commit -m "$(date +%y%m%d)-$(date +%H%M)-Kim"
git push origin master
