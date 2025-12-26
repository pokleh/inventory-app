@echo off
echo ========================================
echo  Step 5: Push to GitHub
echo ========================================
echo.

cd /d "C:\Users\Mohd Fauzi\inventory-app"

echo Pushing code to GitHub...
git push -u origin main

if errorlevel 1 (
    echo.
    echo ERROR: Failed to push to GitHub!
    echo.
    echo Possible causes:
    echo 1. Authentication required - you may need to login to GitHub
    echo 2. Network connectivity issues
    echo 3. Repository URL incorrect
    echo.
    echo Try opening GitHub in your browser and check if you're logged in.
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo  🎉 SUCCESS! Project pushed to GitHub!
echo ========================================
echo.
echo Visit your repository at:
echo https://github.com/pokleh/inventory-app
echo.
echo You can now continue developing your inventory application!
echo.
pause
