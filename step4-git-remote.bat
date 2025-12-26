@echo off
echo ========================================
echo  Step 4: Add GitHub Remote
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Adding GitHub repository as remote origin...
git remote add origin https://github.com/pokleh/inventory-app.git

if errorlevel 1 (
    echo.
    echo WARNING: Remote might already exist.
    echo Trying to remove and re-add...
    git remote remove origin
    git remote add origin https://github.com/pokleh/inventory-app.git

    if errorlevel 1 (
        echo.
        echo ERROR: Still failed to add remote!
        echo.
        pause
        exit /b 1
    )
)

echo.
echo SUCCESS: GitHub remote added!
echo.
echo Next step: Run step5-git-push.bat
echo.
pause
