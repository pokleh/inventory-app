@echo off
echo ========================================
echo  Step 1: Initialize Git Repository
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Initializing Git repository...
git init

if errorlevel 1 (
    echo.
    echo ERROR: Failed to initialize Git repository!
    echo Please make sure Git is installed and try again.
    echo.
    pause
    exit /b 1
)

echo.
echo SUCCESS: Git repository initialized!
echo.
echo You should now see a .git folder in the directory.
echo.
echo Next step: Run step2-git-add.bat
echo.
pause
