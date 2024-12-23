***!! 주의/중요 . 화일 사이즈와 압축화일 관련 주의사항.***

*** 문서 접근시 404가 뜨는 경우는 로그인이 안된 상태이므로 먼저 로그인을 반드시 해주셔야 됩니다 ***

    문서는 git 서버이므로 화일당 20MB가 넘지 않도록 주의하여 주시고 가급적  압축 화일을 풀어서 올리는 것을 부탁드립니다. 

한개의 화일 크기가 너무 크면 git 서버에서 Raw View 하는 경우 서버가 다운되는 경우가 있습니다.


**A. 사용자 등록.** 
    http://git.daboryhost.com/  로 오셔서 사용자 등록을 부탁드립니다.

    git 서버 관리자가 사용자를 해당 사이트 콜레보레이터로 등록한 후에만  git repository를 사용할 수 있습니다.

    !!! 주의: 사용자 등록 후 반드시 로그인 할 때 자동로그인 되도록 Remember Me 를 Check 해 주세요. 



**B. git 의 설치**

a. Windows PC의 경우: 

    https://git-scm.com/book/ko/v2/%EC%8B%9C%EC%9E%91%ED%95%98%EA%B8%B0-Git-%EC%84%A4%EC%B9%98


**C. git 의 사용 - 커맨드 모드/해당폴더에서**

a. 문서가 있는 폴더에서 
  
    \# git clone 현재페이지 URL

    예) git clone http://git.daboryhost.com/xxxxxx-docu
   
하면 xxxxxx-docu 폴더가 만들어 집니다. 


*** git root 폴더(.git folder를 포함하고 있는 폴더)***
*** 쉘 화일이 긴 것은 앞에 3자 이상 입력하고 탭을 치면 자동 완성이 됩니다. ***

b.  push 하려고 하는 화일을 git의 root 폴더로 복사한 후 해당 폴더로 디렉토리를 옮겨서 (change directory) 
  
    \# sh shell/gitpush-you-can-change-name-by-editing-this-file.sh
   
    로 실행하시면 git  폴더의 변화가 git server에 반영되면서 변경 내용이 서버에 일괄 업로드됩니다. 

push 하는 사람의 별명을 바꾸고 싶으시면 shell/gitpush-you-can-change-name-by-editing-this-file.sh 화일을 열어 Kim을 원하시는 본인 닉네임으로 바꾸십시요.


c. git pull 은 해당 폴더에서 단순히 

    \# sh shell/gitpull-origin-master.sh
   
로 하시면 다른 협업자가 변경하거나 추가한 문서 내용이 나의 git 폴더에 반영 됩니다. 


d. 일반적으로 내가 수정한 것을 push 하려면 먼저 gitpull을 한 후  gitpush 해야 합니다. 이것을 좀 더 간편하게 하려면 
  
    \# sh shell/gitpp-git-push-and-pull-simultaneously.sh
   
로 하시면 변화된 내용이 gitpull 과 gitpush가 동시에 수행됩니다. 


e. (중요) git 실행시 화일 충돌이 생겨 에러가 나는 경우.(동시에 2명의 작업자가 동일한 화일을 수정한 경우)
   
    (1) 화일을 에디터로 열면 충돌난 부분이 <<<<<<<<< 수정 부분 >>>>>>>>> 이렇게 표시됩니다. 
    (2) 해당 충돌 부분에 대해 원하시는 형태로 수정한 후 (d. gitpp) 로 동기화 하십시요.
이후의 에러의 경우 알려주시면 조치해드리겠습니다.

f. gitpush 와 gitpull 은 복잡한 git 명령어를 일반인들이 간단하게 사용할 수 있도록 만든 shell script이며 에디터로 내용을 변경하거나 수정하여 사용할 수 있습니다.

g. gitpush 나 gitpp 시 [git] fatal : unable to auto-detect email 관련 오류 해결방법

    \# git config --global user.email "깃서버email"

    \# git config --global user.name "깃서버ID"

이 문제는 git의 login email을 Local PC에 저장하여 즉시 git 의 동기화를 할 수 있도록 합니다.
