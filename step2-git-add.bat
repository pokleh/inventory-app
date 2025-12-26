@echo off
echo ========================================
echo  Step 2: Add All Files to Git
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Adding all files to Git staging area...
git add .

if errorlevel 1 (
    echo.
    echo ERROR: Failed to add files!
    echo.
    pause
    exit /b 1
)

echo.
echo SUCCESS: All files added to staging area!
echo.
echo Next step: Run step3-git-commit.bat
echo.
pause
