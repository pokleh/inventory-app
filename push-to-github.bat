@echo off
echo ========================================
echo  Push CodeIgniter Project to GitHub
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Step 1: Initialize Git Repository
echo ----------------------------------
git init
if errorlevel 1 (
    echo ERROR: Failed to initialize git repository
    pause
    exit /b 1
)
echo.

echo Step 2: Add All Files
echo ---------------------
git add .
if errorlevel 1 (
    echo ERROR: Failed to add files
    pause
    exit /b 1
)
echo.

echo Step 3: Create Initial Commit
echo -----------------------------
git commit -m "Initial commit: CodeIgniter 4 project setup"
if errorlevel 1 (
    echo ERROR: Failed to create commit
    pause
    exit /b 1
)
echo.

echo Step 4: Add GitHub Remote
echo -------------------------
git remote add origin https://github.com/pokleh/inventory-app.git
if errorlevel 1 (
    echo WARNING: Remote might already exist, continuing...
)
echo.

echo Step 5: Push to GitHub
echo ----------------------
git push -u origin main
if errorlevel 1 (
    echo ERROR: Failed to push to GitHub
    echo.
    echo Possible issues:
    echo - Authentication required (need to login to GitHub)
    echo - Repository URL incorrect
    echo - Network connectivity issues
    echo.
    pause
    exit /b 1
)
echo.

echo ========================================
echo SUCCESS! Project pushed to GitHub!
echo ========================================
echo.
echo Visit: https://github.com/pokleh/inventory-app
echo.
pause
