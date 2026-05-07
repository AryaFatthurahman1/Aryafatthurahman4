"""
Model Routes - API endpoints untuk model ML
"""

from flask import Blueprint, request, jsonify
from datetime import datetime
import json
from config.database import get_db_connection
from utils.data_handler import DataHandler

model_routes = Blueprint('models', __name__, url_prefix='/api/models')


@model_routes.route('/', methods=['GET'])
def get_all_models():
    """Mendapatkan semua models"""
    db = get_db_connection()
    
    try:
        query = "SELECT * FROM ml_models ORDER BY created_at DESC"
        models = db.execute_query(query)
        
        return jsonify({
            'status': 'success',
            'data': models,
            'count': len(models) if models else 0
        }), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@model_routes.route('/<int:model_id>', methods=['GET'])
def get_model(model_id):
    """Mendapatkan detail model"""
    db = get_db_connection()
    
    try:
        query = "SELECT * FROM ml_models WHERE model_id = %s"
        model = db.execute_query(query, (model_id,))
        
        if model:
            return jsonify({'status': 'success', 'data': model[0]}), 200
        
        return jsonify({'status': 'error', 'message': 'Model tidak ditemukan'}), 404
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@model_routes.route('/', methods=['POST'])
def create_model():
    """Membuat model baru"""
    db = get_db_connection()
    
    try:
        data = request.get_json()
        
        required_fields = ['user_id', 'model_name', 'model_type', 'algorithm']
        if not all(field in data for field in required_fields):
            return jsonify({'status': 'error', 'message': 'Missing required fields'}), 400
        
        query = """
            INSERT INTO ml_models 
            (user_id, model_name, model_type, algorithm, dataset_id, status)
            VALUES (%s, %s, %s, %s, %s, %s)
        """
        
        dataset_id = data.get('dataset_id', None)
        status = data.get('status', 'training')
        
        db.execute_update(query, (
            data['user_id'],
            data['model_name'],
            data['model_type'],
            data['algorithm'],
            dataset_id,
            status
        ))
        
        return jsonify({
            'status': 'success',
            'message': 'Model created successfully'
        }), 201
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@model_routes.route('/<int:model_id>/metrics', methods=['PUT'])
def update_model_metrics(model_id):
    """Update metrics model"""
    db = get_db_connection()
    
    try:
        data = request.get_json()
        
        query = """
            UPDATE ml_models
            SET accuracy=%s, `precision`=%s, `recall`=%s, f1_score=%s, status=%s
            WHERE model_id=%s
        """
        
        db.execute_update(query, (
            data.get('accuracy'),
            data.get('precision'),
            data.get('recall'),
            data.get('f1_score'),
            data.get('status', 'completed'),
            model_id
        ))
        
        return jsonify({'status': 'success', 'message': 'Metrics updated'}), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@model_routes.route('/<int:model_id>/predict', methods=['POST'])
def predict(model_id):
    """Melakukan prediksi"""
    db = get_db_connection()
    
    try:
        data = request.get_json()
        user_id = data.get('user_id', 1)
        features = data.get('features', [])
        
        # TODO: Implementasi logic prediksi dengan model
        # Untuk sekarang, return placeholder
        
        prediction = "pending"
        confidence = 0.0
        
        # Simpan ke database
        DataHandler.save_prediction_to_db(
            model_id, user_id, features, prediction, confidence
        )
        
        return jsonify({
            'status': 'success',
            'prediction': prediction,
            'confidence': confidence
        }), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()


@model_routes.route('/<int:model_id>', methods=['DELETE'])
def delete_model(model_id):
    """Menghapus model"""
    db = get_db_connection()
    
    try:
        query = "DELETE FROM ml_models WHERE model_id = %s"
        db.execute_update(query, (model_id,))
        
        return jsonify({'status': 'success', 'message': 'Model deleted'}), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
    
    finally:
        db.disconnect()
