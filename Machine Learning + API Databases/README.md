# 🤖 Machine Learning + API Database Project

A complete machine learning project with Flask API backend, MySQL database, and interactive web dashboard built with Python, HTML, and CSS.

## 📋 Project Structure

```
├── backend/
│   ├── config/          - Database configuration
│   ├── ml_models/       - ML model implementations
│   ├── routes/          - API endpoints
│   ├── utils/           - Helper functions
│   ├── app.py           - Main Flask application
│   └── .env.example     - Environment variables template
├── database/
│   └── sql/
│       └── schema.sql   - MySQL database schema
├── frontend/
│   └── dashboard.html   - Interactive dashboard
├── requirements.txt     - Python dependencies
├── setup.bat            - Windows setup script
├── run_api.bat          - Windows API runner
└── SETUP.py             - Automated setup script
```

## 🚀 Quick Start (Windows with Laragon)

### Step 1: Prerequisites
- **Laragon** installed (includes PHP, MySQL, Apache)
- **Python 3.7+** installed and available in PATH
- Project placed in `D:\laragon\www\Machine Learning + API Databases\`

### Step 2: Initial Setup
Double-click `setup.bat` to:
- Create Python virtual environment
- Install dependencies from `requirements.txt`
- Run `SETUP.py` to initialize database

```bash
# Or run manually:
python SETUP.py
```

This will:
- ✓ Connect to MySQL
- ✓ Create database `ml_api_db`
- ✓ Import database schema
- ✓ Create necessary directories
- ✓ Generate `.env` configuration file

### Step 3: Run API Server
Double-click `run_api.bat` or run:

```bash
cd backend
python app.py
```

The API will start on `http://localhost:5000/api`

### Step 4: Access Dashboard
Open in your browser:
```
http://localhost/Machine%20Learning%20+%20API%20Databases/frontend/dashboard.html
```

Or through Laragon's built-in server:
```
http://localhost:8080/Machine%20Learning%20+%20API%20Databases/frontend/dashboard.html
```

## 📊 Database Setup

### MySQL Database Schema
The `database/sql/schema.sql` file includes tables for:

- **users** - User accounts and authentication
- **datasets** - Machine learning datasets
- **ml_models** - Trained ML models (classification, regression)
- **predictions** - Model prediction results
- **api_logs** - API request/response logs
- **training_history** - Model training metrics
- **feature_importance** - Feature importance scores

### Access Database Management
```
http://localhost/phpmyadmin
Username: root
Password: (Laragon default - usually empty)
```

## 🔧 Configuration

### Environment Variables (.env)
Create `backend/.env` from `backend/.env.example`:

```env
# Database Configuration
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=ml_api_db
DB_PORT=3306

# API Configuration
API_HOST=0.0.0.0
API_PORT=5000
FLASK_DEBUG=True
```

### Important Locations
- Database config: `backend/config/database.py`
- Models: `backend/ml_models/`
- API routes: `backend/routes/`
- Database schema: `database/sql/schema.sql`

## 🎯 API Endpoints

### Health & Status
```
GET /api/health                 - API health check
GET /api/db-status             - Database connection status
```

### Models
```
GET    /api/models             - List all models
GET    /api/models/<id>        - Get specific model
POST   /api/models             - Create new model
PUT    /api/models/<id>/metrics - Update model metrics
DELETE /api/models/<id>        - Delete model
```

### Predictions
```
GET    /api/predictions        - List all predictions
GET    /api/predictions/<id>   - Get specific prediction
POST   /api/predictions        - Create new prediction
DELETE /api/predictions/<id>   - Delete prediction
```

### Users
```
GET    /api/users              - List all users
GET    /api/users/<id>         - Get user details
POST   /api/users              - Create new user
```

## 🤖 Machine Learning Models

### Classification Models
- Random Forest Classifier
- Gradient Boosting Classifier
- Logistic Regression
- Support Vector Machine (SVM)

### Regression Models
- Random Forest Regressor
- Gradient Boosting Regressor
- Linear Regression
- Ridge & Lasso Regression

Located in `backend/ml_models/` directory.

## 📦 Dependencies

Key Python packages (see `requirements.txt`):
- **Flask** - Web framework
- **flask-cors** - CORS support
- **mysql-connector-python** - MySQL driver
- **scikit-learn** - Machine learning library
- **pandas** - Data manipulation
- **numpy** - Numerical computing
- **python-dotenv** - Environment variables

Install all dependencies:
```bash
pip install -r requirements.txt
```

## 🌐 Frontend Dashboard

Interactive dashboard features:
- Real-time database status monitoring
- API server health check
- Model statistics and predictions
- Quick setup guide
- Direct links to PHPMyAdmin and API
- Responsive design (desktop & mobile)

### Technologies
- HTML5
- CSS3 (Flexbox, Grid, Animations)
- Vanilla JavaScript (Fetch API)
- Modern gradient designs

## 🔒 Security Notes

1. **Change SECRET_KEY** in production
2. **Update database credentials** in `.env`
3. **Use HTTPS** in production
4. **Set FLASK_DEBUG=False** in production
5. **Implement authentication** for API endpoints
6. **Validate all inputs** server-side

## 🐛 Troubleshooting

### MySQL Connection Error
- Ensure MySQL is running (check Laragon)
- Verify credentials in `backend/.env`
- Check database host/port settings

### Port Already in Use
- Change `API_PORT` in `backend/.env`
- Check for other Flask instances running

### Dependencies Not Found
```bash
# Reinstall dependencies
pip install --upgrade -r requirements.txt
```

### Dashboard Not Loading
- Check browser console for errors
- Ensure API server is running
- Verify Laragon server is running

## 📝 Project Features

✅ Complete CRUD API for ML models
✅ Database schema with foreign keys & indexes
✅ Interactive web dashboard
✅ Real-time status monitoring
✅ Automated setup script
✅ CORS enabled for cross-origin requests
✅ Error handling & logging
✅ Responsive, modern UI design
✅ Multiple ML algorithm support
✅ Prediction tracking system

## 🎓 Learning Resources

- Flask Documentation: https://flask.palletsprojects.com/
- scikit-learn: https://scikit-learn.org/
- MySQL: https://dev.mysql.com/doc/
- Laragon: https://laragon.org/

## 📄 License

This project is open source and available under the MIT License.

## 👨‍💻 Development

### Local Development
1. Always activate virtual environment: `venv\Scripts\activate`
2. Keep `.env` updated with your settings
3. Test API endpoints with Postman or similar
4. Use Flask's debug mode during development

### Project Structure Best Practices
- Keep routes organized by feature
- Put database operations in handlers
- Use utility functions for repetitive code
- Comment complex logic
- Follow PEP 8 style guide

## 📞 Support

For issues or questions:
1. Check the troubleshooting section
2. Review error logs in `backend/logs/`
3. Check API response in browser console
4. Verify database connection in PHPMyAdmin

---

**Last Updated:** April 2024
**Version:** 1.0.0
**Status:** Development
