"""
Prediction Routes - API endpoints untuk prediksi
"""

from flask import Blueprint, request, jsonify
from config.database import get_db_connection
from utils.data_handler import DataHandler

prediction_routes = Blueprint('predictions', __name__, url_prefix='/api/predictions')


@prediction_routes.route('/', methods=['GET'])
def get_predictions():
    """Mendapatkan semua prediksi"""
    db = get_db_connection()
    
    try:
        user_id = request.args.get('user_id')
        model_id = request.args.get('model_id')
        
        if user_id and model_id:
            query = "SELECT * FROM predictions WHERE user_id=%s AND model_id=%s"
            predictions = db.execute_query(query, (user_id, model_id))
        elif user_id:
            query = "SELECT * FROM predictions WHERE user_id=%s"
            predictions = db.execute_query(query, (user_id,))
        else:
            query = "SELECT * FROM predictions ORDER BY created_at DESC LIMIT 100"
            predictions = db.execute_query(query)
        
        return jsonify({
            'status': 'success',
            'data': predictions,
            'count': len(predictions) if predictions else 0
        }), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@prediction_routes.route('/', methods=['POST'])
def create_prediction():
    """Membuat prediksi baru"""
    db = get_db_connection()
    
    try:
        data = request.get_json()
        
        required_fields = ['model_id', 'user_id', 'predicted_value']
        if not all(field in data for field in required_fields):
            return jsonify({'status': 'error', 'message': 'Missing required fields'}), 400
        
        query = """
            INSERT INTO predictions 
            (model_id, user_id, input_data, predicted_value, confidence)
            VALUES (%s, %s, %s, %s, %s)
        """
        
        input_data = data.get('input_data', {})
        import json
        input_json = json.dumps(input_data)
        
        db.execute_update(query, (
            data['model_id'],
            data['user_id'],
            input_json,
            data['predicted_value'],
            data.get('confidence', 0.0)
        ))
        
        return jsonify({
            'status': 'success',
            'message': 'Prediction saved successfully'
        }), 201
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@prediction_routes.route('/<int:prediction_id>', methods=['GET'])
def get_prediction(prediction_id):
    """Mendapatkan detail prediksi"""
    db = get_db_connection()
    
    try:
        query = "SELECT * FROM predictions WHERE prediction_id = %s"
        prediction = db.execute_query(query, (prediction_id,))
        
        if prediction:
            return jsonify({'status': 'success', 'data': prediction[0]}), 200
        
        return jsonify({'status': 'error', 'message': 'Prediction not found'}), 404
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@prediction_routes.route('/stats', methods=['GET'])
def get_prediction_stats():
    """Mendapatkan statistik prediksi"""
    db = get_db_connection()
    
    try:
        query = """
            SELECT 
                COUNT(*) as total_predictions,
                AVG(confidence) as avg_confidence,
                MIN(confidence) as min_confidence,
                MAX(confidence) as max_confidence
            FROM predictions
        """
        
        stats = db.execute_query(query)
        
        return jsonify({
            'status': 'success',
            'data': stats[0] if stats else {}
        }), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()
