@echo off
REM Batch file untuk menjalankan training examples
REM Double-click file ini untuk jalankan contoh training

cls
echo ╔════════════════════════════════════════════════╗
echo ║   Machine Learning Training Examples           ║
echo ║   Python + MySQL + Laragon                     ║
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

REM Run examples
echo.
echo Running training examples...
echo.
python EXAMPLES.py

pause
