"""
Flask API Application
Machine Learning + Data Sciences Backend API
"""

from flask import Flask, jsonify
from flask_cors import CORS
from datetime import datetime
import sys
import os

# Add backend to path
sys.path.insert(0, os.path.dirname(__file__))

# Import routes
from routes.models import model_routes
from routes.predictions import prediction_routes
from routes.users import user_routes
from config.database import get_db_connection, DatabaseConfig

# Create Flask app
app = Flask(__name__)

# Configure Flask
app.config['JSON_SORT_KEYS'] = False
app.config['JSONIFY_PRETTYPRINT_REGULAR'] = True

# Enable CORS
CORS(app, resources={
    r"/api/*": {
        "origins": ["*"],
        "methods": ["GET", "POST", "PUT", "DELETE", "OPTIONS"],
        "allow_headers": ["Content-Type", "Authorization"]
    }
})

# Register blueprints
app.register_blueprint(model_routes)
app.register_blueprint(prediction_routes)
app.register_blueprint(user_routes)


# ================================================
# Health Check Endpoints
# ================================================

@app.route('/api/health', methods=['GET'])
def health_check():
    """Check API health"""
    return jsonify({
        'status': 'up',
        'timestamp': datetime.now().isoformat(),
        'service': 'ML API Server'
    }), 200


@app.route('/api/db-status', methods=['GET'])
def db_status():
    """Check database connection"""
    db = get_db_connection()
    
    try:
        # Try to query something simple
        result = db.execute_query("SELECT 1 as status")
        
        if result:
            return jsonify({
                'status': 'connected',
                'database': 'ml_api_db',
                'timestamp': datetime.now().isoformat()
            }), 200
    
    except Exception as e:
        return jsonify({
            'status': 'error',
            'message': str(e)
        }), 500
    
    finally:
        db.disconnect()


# ================================================
# Base Endpoint
# ================================================

@app.route('/api', methods=['GET'])
def root():
    """Root API endpoint"""
    return jsonify({
        'message': 'Welcome to Machine Learning + Data Sciences API',
        'version': '1.0.0',
        'endpoints': {
            'health': '/api/health',
            'db_status': '/api/db-status',
            'models': '/api/models',
            'predictions': '/api/predictions',
            'users': '/api/users'
        }
    }), 200


# ================================================
# Error Handlers
# ================================================

@app.errorhandler(404)
def not_found(error):
    """Handle 404 errors"""
    return jsonify({
        'status': 'error',
        'message': 'Endpoint not found',
        'code': 404
    }), 404


@app.errorhandler(500)
def server_error(error):
    """Handle 500 errors"""
    return jsonify({
        'status': 'error',
        'message': 'Internal server error',
        'code': 500
    }), 500


@app.errorhandler(400)
def bad_request(error):
    """Handle 400 errors"""
    return jsonify({
        'status': 'error',
        'message': 'Bad request',
        'code': 400
    }), 400


# ================================================
# Run Application
# ================================================

if __name__ == '__main__':
    print("""
    ╔════════════════════════════════════════════════╗
    ║  Machine Learning + Data Sciences API Server   ║
    ║                Version 1.0.0                    ║
    ╚════════════════════════════════════════════════╝
    """)
    
    # read host/port from environment so deployment can change them
    api_host = os.getenv('API_HOST', '0.0.0.0')
    api_port = int(os.getenv('API_PORT', 5000))
    debug_mode = os.getenv('FLASK_DEBUG', 'True').lower() in ('1', 'true', 'yes')

    print("🚀 Starting server...")
    print(f"📊 Database: {DatabaseConfig.DB_NAME}")
    print(f"🔌 Host: {api_host}:{api_port}")
    print(f"💻 Environment: {'development' if debug_mode else 'production'}")
    print("\n✓ API Ready for requests!")
    print(f"📍 Visit: http://{api_host}:{api_port}/api\n")
    
    app.run(
        host=api_host,
        port=api_port,
        debug=debug_mode,
        use_reloader=debug_mode
    )
