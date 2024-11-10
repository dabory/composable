#!/bin/bash
git add .
git commit -m "$(date +%y%m%d)-$(date +%H%M)-Kim"
git push origin master
