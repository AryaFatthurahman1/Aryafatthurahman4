# ✅ Setup Verification Checklist

## Pre-Setup Verification

### System Requirements
- [ ] Windows 10/11 installed
- [ ] Laragon installed (includes Apache, MySQL, PHP)
- [ ] Python 3.8+ installed
  - [ ] Check via: `python --version` in cmd
  - [ ] Python added to PATH (can run `python` from any directory)
- [ ] Project folder exists: `D:\laragon\www\Machine Learning + API Databases\`

### Project Files Present
- [ ] `setup.bat` exists
- [ ] `run_api.bat` exists  
- [ ] `SETUP.py` exists
- [ ] `README.md` exists
- [ ] `QUICKSTART.md` exists
- [ ] `requirements.txt` exists
- [ ] `backend/` folder exists
- [ ] `database/` folder with `sql/schema.sql` exists
- [ ] `frontend/dashboard.html` exists
- [ ] `frontend/dashboard.css` exists

---

## Database Setup Verification

### After Running setup.bat

- [ ] Virtual environment created (`.venv\` folder exists)
- [ ] Dependencies installed (can run `pip list` and see Flask, mysql-connector, etc.)
- [ ] Database `ml_api_db` created
  - [ ] Verify in PHPMyAdmin: http://localhost/phpmyadmin
  - [ ] Check database exists in left panel
- [ ] Database tables created:
  - [ ] `users` table
  - [ ] `datasets` table
  - [ ] `ml_models` table
  - [ ] `predictions` table
  - [ ] `api_logs` table
  - [ ] `training_history` table
  - [ ] `feature_importance` table

### Configuration Verification

- [ ] `backend/.env` file exists
- [ ] `.env` contains database credentials:
  ```
  DB_HOST=localhost
  DB_USER=root
  DB_NAME=ml_api_db
  ```
- [ ] `backend/config/database.py` properly configured
- [ ] All necessary directories created:
  - [ ] `backend/models/`
  - [ ] `backend/data/`
  - [ ] `backend/uploads/`
  - [ ] `backend/logs/`

---

## API Server Verification

### Start API Server
1. [ ] Double-click `run_api.bat`
2. [ ] Wait for message: "✓ API Ready for requests!"
3. [ ] Keep command window open

### Test API Health

- [ ] Open browser: http://localhost:5000/api/health
  - [ ] Response contains: `"status": "up"`
- [ ] Open browser: http://localhost:5000/api/db-status
  - [ ] Response contains: `"status": "connected"`
- [ ] Open browser: http://localhost:5000/api
  - [ ] Response shows API endpoints list

### Test API Endpoints

#### GET Requests
- [ ] http://localhost:5000/api/models (should list models)
- [ ] http://localhost:5000/api/predictions (should list predictions)
- [ ] http://localhost:5000/api/users (should list users)

---

## Frontend Dashboard Verification

### Access Dashboard
1. [ ] Start Laragon (Apache and MySQL running)
2. [ ] Keep `run_api.bat` running
3. [ ] Open browser to dashboard:
   ```
   http://localhost/Machine%20Learning%20+%20API%20Databases/frontend/dashboard.html
   ```

### Dashboard Elements

- [ ] Header loads with title "🤖 Machine Learning Dashboard"
- [ ] Subtitle shows "Laragon + Python + MySQL + Machine Learning + API"
- [ ] Database Status card shows one of:
  - [ ] ✓ Connected (green)
  - [ ] ✗ Offline (red)
- [ ] API Server card shows one of:
  - [ ] ✓ Running (green)
  - [ ] ✗ Offline (red)
- [ ] Models count card shows number
- [ ] Predictions count card shows number
- [ ] Users card shows "1"

### Dashboard Links Working

- [ ] 🗄️ PHPMyAdmin link works → http://localhost/phpmyadmin
- [ ] 🔌 API Endpoint link works → http://localhost:5000/api
- [ ] 🌐 HTTP Server link works → http://localhost:8080
- [ ] 💻 Code Structure button shows folder structure

### Dashboard Styling

- [ ] Background gradient displays correctly
- [ ] Cards have proper shadows and hover effects
- [ ] Buttons are clickable with hover animations
- [ ] Status badges (✓ Connected / ✗ Offline) display correctly
- [ ] Code blocks have dark background
- [ ] Layout is responsive (test by resizing browser)

---

## Database Content Verification

### In PHPMyAdmin

1. [ ] Navigate to: http://localhost/phpmyadmin
2. [ ] Select database: `ml_api_db`
3. [ ] Verify sample data:
   - [ ] `users` table has 1 admin user
   - [ ] `datasets` table has 1 sample dataset
   - [ ] Other tables exist and are empty (this is normal)

### Via API

- [ ] GET http://localhost:5000/api/users returns admin user
- [ ] GET http://localhost:5000/api/models returns JSON array (empty or with data)

---

## Code & Configuration Verification

### HTML/CSS Quality

- [ ] `frontend/dashboard.html` has no validation errors
- [ ] External CSS file exists: `frontend/dashboard.css`
- [ ] All inline styles removed from HTML ✓
- [ ] All target="_blank" links have `rel="noopener noreferrer"` ✓
- [ ] Responsive design works on mobile screens ✓

### SQL Schema

- [ ] `database/sql/schema.sql` has no syntax errors ✓
- [ ] All tables have proper MySQL syntax ✓
- [ ] Foreign key relationships defined ✓
- [ ] Indexes created for performance ✓

### Python Backend

- [ ] `backend/app.py` imports correct modules ✓
- [ ] Flask app initializes without errors
- [ ] CORS enabled for API access ✓
- [ ] Database connection works ✓
- [ ] All routes registered properly ✓

---

## Browser Developer Tools Check

### Open Browser Console (F12)

- [ ] No JavaScript errors in console
- [ ] No warnings about security issues
- [ ] API calls in Network tab show 200/201 status codes
- [ ] CSS loaded from `dashboard.css`

### Network Tab
- [ ] All CSS files load successfully (200 status)
- [ ] API calls return JSON with 200 status
- [ ] No CORS errors

---

## Common Issues & Solutions

If any verification fails:

### Issue: "Cannot find module 'mysql'"
- [ ] Run setup.bat again
- [ ] Delete `.venv` folder and run setup.bat
- [ ] Verify Python installation

### Issue: "Port 5000 already in use"
- [ ] Edit `backend/.env` and change `API_PORT=5001`
- [ ] Restart `run_api.bat`

### Issue: "Connection refused"
- [ ] Start Laragon (MySQL must be running)
- [ ] Verify credentials in `.env`
- [ ] Try again after 10 seconds

### Issue: Dashboard shows "✗ Offline"
- [ ] Check if `run_api.bat` window is still open
- [ ] Refresh page (F5)
- [ ] Check API health: http://localhost:5000/api/health

### Issue: Database tables not created
- [ ] Run setup.bat again
- [ ] Check PHPMyAdmin to see if tables exist
- [ ] Delete database in PHPMyAdmin and start over

---

## Final Checklist

### Everything Ready?
- [ ] Laragon installed and working
- [ ] Python installed with PATH set
- [ ] Project files downloaded/placed correctly
- [ ] setup.bat ran successfully
- [ ] API server (run_api.bat) is running
- [ ] Dashboard loads without errors
- [ ] Database tables visible in PHPMyAdmin
- [ ] API endpoints respond to requests
- [ ] Status indicators show green (Connected/Running)

### You're Ready When:
✅ **Dashboard opens and shows** "✓ Connected" **and** "✓ Running"
✅ **API endpoints respond** with correct data
✅ **Database tables** are visible in PHPMyAdmin
✅ **No errors** in browser console (F12)

---

## Next Steps

Once verified:

1. **Explore API:** Test all endpoints with Postman or browser
2. **Add Data:** Use PHPMyAdmin to add more users, datasets, models
3. **Test Predictions:** Create predictions via API
4. **Customize:** Modify dashboard, add new features
5. **Deploy:** When ready, deploy to production

---

## Support Resources

- **Quick Start:** Read `QUICKSTART.md`
- **Full Guide:** Read `README.md`
- **API Details:** Check routes in `backend/routes/`
- **Database Schema:** Review `database/sql/schema.sql`
- **Environment:** Edit `backend/.env`

---

## Completion

Date Verified: _______________

Verified By: _______________

Status: ☐ All checks passed - Ready for use! ✓
        ☐ Some issues found - See notes below

**Notes:**
_______________________________________________________________

_______________________________________________________________

_______________________________________________________________

---

**Generated:** April 2024
**Version:** 1.0.0
**Project:** Machine Learning + API Database
