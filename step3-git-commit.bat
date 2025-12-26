@echo off
echo ========================================
echo  Step 3: Create Initial Commit
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Creating initial commit...
git commit -m "Initial commit: CodeIgniter 4 project setup"

if errorlevel 1 (
    echo.
    echo ERROR: Failed to create commit!
    echo This might be because there are no changes to commit.
    echo.
    pause
    exit /b 1
)

echo.
echo SUCCESS: Initial commit created!
echo.
echo Next step: Run step4-git-remote.bat
echo.
pause
