@echo off
REM Batch file untuk setup database
REM Double-click file ini untuk auto setup

cls
echo ╔════════════════════════════════════════════════╗
echo ║   Database & Project Setup                     ║
echo ║   Machine Learning + Data Sciences            ║
echo ╚════════════════════════════════════════════════╝
echo.

REM Check if virtual environment exists
if not exist "venv" (
    echo Creating virtual environment...
    python -m venv venv
)

REM Activate virtual environment
call venv\Scripts\activate.bat

REM Install requirements if needed
python -m pip show flask >nul 2>&1
if errorlevel 1 (
    echo Installing dependencies...
    pip install -r requirements.txt
)

REM Run setup script
echo.
echo Running setup script...
echo.
python SETUP.py

pause
