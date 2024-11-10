#!/bin/bash
#git reset –hard

git config credential.helper store
git pull origin main 

git add .
git commit -m "$(date +%y%m%d)-$(date +%H%M)-Kim"
git push origin main 
