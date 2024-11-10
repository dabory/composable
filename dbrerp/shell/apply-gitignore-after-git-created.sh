#!/bin/bash

git rm -r --cached .
git add .
git commit -m "Apply .gitignore"
git push
