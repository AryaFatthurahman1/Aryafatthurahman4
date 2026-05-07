# 🚀 Quick Start Guide - Windows + Laragon

## Prerequisites ✓
- **Laragon** installed in default location (includes Apache, MySQL, PHP)
- **Python 3.8+** installed and in system PATH
- Project folder: `D:\laragon\www\Machine Learning + API Databases\`

## 5-Minute Setup

### 1. Start Laragon
Click the **Laragon icon** in system tray → **Start All** (or click "Start" button)
```
Should show: Apache (running), MySQL (running)
```

### 2. Initialize Database
Double-click **`setup.bat`** in the project root
```
✓ Creates virtual environment
✓ Installs Python dependencies
✓ Creates MySQL database
✓ Imports database schema
```
Wait for completion message.

### 3. Start API Server
Double-click **`run_api.bat`** in the project root
```
Should show:
╔════════════════════════════════════════════════╗
║  Machine Learning + Data Sciences API Server   ║
║                Version 1.0.0                    ║
╚════════════════════════════════════════════════╝

✓ API Ready for requests!
📍 Visit: http://0.0.0.0:5000/api
```
**Keep this window open!**

### 4. Open Dashboard
In your browser, visit:
```
http://localhost/Machine%20Learning%20+%20API%20Databases/frontend/dashboard.html
```

Or through Laragon menu:
```
Right-click Laragon icon → Laragon Menu → Domain Config
Visit the project URL listed
```

## Quick Links

| Service | URL | Purpose |
|---------|-----|---------|
| **Dashboard** | http://localhost/Machine%20Learning%20+%20API%20Databases/frontend/ | Main interface |
| **API Server** | http://localhost:5000/api | REST API endpoints |
| **PHPMyAdmin** | http://localhost/phpmyadmin | Database management |
| **API Health** | http://localhost:5000/api/health | Check if API is running |
| **DB Status** | http://localhost:5000/api/db-status | Check database connection |

## What Each File Does

### .bat Files (Double-click to run)
- **`setup.bat`** - One-time setup (creates DB, installs dependencies)
- **`run_api.bat`** - Starts Flask API server
- **`run_examples.bat`** - Runs example ML scripts (optional)

### Key Files
- **`SETUP.py`** - Database initialization script (auto-run by setup.bat)
- **`backend/app.py`** - Flask application entry point
- **`frontend/dashboard.html`** - Web interface
- **`database/sql/schema.sql`** - Database tables definition
- **`requirements.txt`** - Python dependencies

## Database Info

**Credentials (Laragon Default):**
- **Host:** localhost
- **Port:** 3306
- **User:** root
- **Password:** (empty)
- **Database:** ml_api_db

**Access in PHPMyAdmin:**
```
http://localhost/phpmyadmin
Username: root
Password: (leave empty, just click Login)
Select database: ml_api_db
```

## API Endpoints

### Status Checks
```bash
GET http://localhost:5000/api/health       → API status
GET http://localhost:5000/api/db-status    → Database status
```

### Models
```bash
GET    http://localhost:5000/api/models           → List all models
POST   http://localhost:5000/api/models           → Create model
GET    http://localhost:5000/api/models/1         → Get model #1
```

### Predictions
```bash
GET    http://localhost:5000/api/predictions      → List predictions
POST   http://localhost:5000/api/predictions      → Create prediction
```

### Users
```bash
GET    http://localhost:5000/api/users            → List users
POST   http://localhost:5000/api/users            → Create user
```

## Environment Variables (.env)

File: `backend\.env`

```env
# Database
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=ml_api_db

# API
API_HOST=0.0.0.0
API_PORT=5000
FLASK_DEBUG=True
```

**To change settings:**
1. Open `backend\.env` in any text editor
2. Edit the values
3. Restart `run_api.bat`

## Troubleshooting

### "Error connecting to MySQL"
- ✓ Start Laragon (click "Start All")
- ✓ Check MySQL is running (green icon in Laragon)
- ✓ Run setup.bat again

### "Port 5000 already in use"
- ✓ Change `API_PORT` in `backend\.env` to 5001 or 5002
- ✓ Restart `run_api.bat`

### "Dashboard not loading"
- ✓ Check if `run_api.bat` is running (window should be open)
- ✓ Check browser console for errors (F12)
- ✓ Try http://localhost:5000/api/health in browser

### "Database not found"
- ✓ Run setup.bat again
- ✓ Check PHPMyAdmin: http://localhost/phpmyadmin
- ✓ Verify database `ml_api_db` exists

### "Python not found"
- ✓ Reinstall Python with "Add Python to PATH"
- ✓ Restart computer after Python installation
- ✓ From cmd: `python --version` should work

## Project Structure Reminder

```
Machine Learning + API Databases/
├── backend/
│   ├── config/          Database setup
│   ├── ml_models/       Model implementations
│   ├── routes/          API endpoints
│   ├── app.py           Main Flask app
│   └── .env             Your configuration (auto-created)
├── database/
│   └── sql/schema.sql   Database tables
├── frontend/
│   └── dashboard.html   Web interface
├── setup.bat            ← Double-click first!
├── run_api.bat          ← Double-click second!
└── README.md            Full documentation
```

## Testing Your Setup

### Test 1: Check API is Running
```
Open browser: http://localhost:5000/api
Should see JSON response with API information
```

### Test 2: Check Database Connection
```
Open browser: http://localhost:5000/api/db-status
Should see: {"status": "connected", "database": "ml_api_db", ...}
```

### Test 3: View Dashboard
```
Open browser: http://localhost/Machine%20Learning%20+%20API%20Databases/frontend/dashboard.html
Should see cards with "Connected" and "Running" status
```

## Common Commands (for advanced users)

### From Command Prompt

Activate environment:
```cmd
cd D:\laragon\www\Machine Learning + API Databases
.venv\Scripts\activate
```

Run Python directly:
```cmd
cd backend
python app.py
```

Install additional packages:
```cmd
pip install package-name
```

## Next Steps

1. ✅ Run setup.bat (one time)
2. ✅ Run run_api.bat (keep running)
3. ✅ Open dashboard in browser
4. ✅ Test API endpoints
5. ✅ Explore PHPMyAdmin

## Need Help?

- **Setup issues?** → Check README.md in project root
- **Database issues?** → Check PHPMyAdmin
- **API issues?** → Check http://localhost:5000/api/health
- **Dashboard issues?** → Check browser console (F12)

## Important Notes

- ⚠️ Always start Laragon first (MySQL must be running)
- ⚠️ Keep `run_api.bat` window open while using dashboard
- ⚠️ Changes to `.env` require restart of `run_api.bat`
- ⚠️ Don't modify `schema.sql` after initial setup

---

**Version:** 1.0.0
**Last Updated:** April 2024
**Status:** Ready for use ✓
