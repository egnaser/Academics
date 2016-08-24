set hitCounter=0
set ratingCounter=0
set userIdCounter=0
:loop
start "" "http://technophilia2016.byethost5.com/Akshay/rating.php?project_id=2&project_rating=%ratingCounter%&user_id=%userIdCounter%"
timeout /t 1 /nobreak > NUL
set /a hitCounter = %hitCounter% + 1
REM set /a ratingCounter=(%ratingCounter% + 2)%4
set /a ratingCounter = %RANDOM% * 5 / 32768
set /a userIdCounter=%userIdCounter% + 1
if %hitCounter% == 5 goto kill

goto loop


:kill
taskkill /F /IM chrome.exe
set /a hitCounter = 0
REM set /a ratingCounter=0
if %userIdCounter% NEQ 300 goto loop