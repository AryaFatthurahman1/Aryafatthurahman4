@echo off
REM Batch file untuk menjalankan Machine Learning API Server
REM Double-click file ini untuk menjalankan API

cls
echo ╔════════════════════════════════════════════════╗
echo ║   Machine Learning + Data Sciences API Server  ║
echo ║            Laragon + Python + MySQL            ║
echo ╚════════════════════════════════════════════════╝
echo.

REM Check if virtual environment exists
if not exist "venv" (
    echo Creating virtual environment...
    python -m venv venv
)

REM Activate virtual environment
call venv\Scripts\activate.bat

REM Check if requirements are installed
python -m pip show flask >nul 2>&1
if errorlevel 1 (
    echo.
    echo Installing dependencies...
    pip install -r requirements.txt
)

REM Run the Flask app
REM You can override bind host/port by setting API_HOST/API_PORT environment variables
REM or editing backend\.env file before starting.
echo.
echo ✓ Starting API Server...
echo.
cd backend
python app.py

pause
