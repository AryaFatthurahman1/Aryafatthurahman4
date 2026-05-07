"""
API User & Auth Routes
"""

from flask import Blueprint, request, jsonify
from utils.user_manager import UserManager
import json

user_routes = Blueprint('users', __name__, url_prefix='/api/users')


@user_routes.route('/', methods=['GET'])
def list_users():
    """Mendapatkan list semua users"""
    try:
        users = UserManager.list_users()
        
        return jsonify({
            'status': 'success',
            'data': users,
            'count': len(users) if users else 0
        }), 200
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


@user_routes.route('/<int:user_id>', methods=['GET'])
def get_user(user_id):
    """Mendapatkan info user"""
    try:
        user = UserManager.get_user(user_id)
        
        if user:
            return jsonify({'status': 'success', 'data': user}), 200
        
        return jsonify({'status': 'error', 'message': 'User not found'}), 404
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


@user_routes.route('/register', methods=['POST'])
def register():
    """Register user baru"""
    try:
        data = request.get_json()
        
        required_fields = ['username', 'email', 'password']
        if not all(field in data for field in required_fields):
            return jsonify({'status': 'error', 'message': 'Missing required fields'}), 400
        
        user_id = UserManager.create_user(
            username=data['username'],
            email=data['email'],
            password=data['password'],
            full_name=data.get('full_name', None)
        )
        
        if user_id:
            return jsonify({
                'status': 'success',
                'message': 'User registered successfully',
                'user_id': user_id
            }), 201
        else:
            return jsonify({
                'status': 'error',
                'message': 'Registration failed'
            }), 400
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


@user_routes.route('/login', methods=['POST'])
def login():
    """Login user"""
    try:
        data = request.get_json()
        
        if 'username' not in data or 'password' not in data:
            return jsonify({
                'status': 'error',
                'message': 'Username and password required'
            }), 400
        
        user = UserManager.authenticate(
            username=data['username'],
            password=data['password']
        )
        
        if user:
            return jsonify({
                'status': 'success',
                'message': 'Login successful',
                'user': user
            }), 200
        else:
            return jsonify({
                'status': 'error',
                'message': 'Invalid credentials'
            }), 401
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


@user_routes.route('/<int:user_id>', methods=['PUT'])
def update_user(user_id):
    """Update user information"""
    try:
        data = request.get_json()
        
        success = UserManager.update_user(user_id, **data)
        
        if success:
            return jsonify({
                'status': 'success',
                'message': 'User updated successfully'
            }), 200
        else:
            return jsonify({
                'status': 'error',
                'message': 'Update failed'
            }), 400
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500


@user_routes.route('/<int:user_id>', methods=['DELETE'])
def delete_user(user_id):
    """Menghapus user"""
    try:
        success = UserManager.delete_user(user_id)
        
        if success:
            return jsonify({
                'status': 'success',
                'message': 'User deleted'
            }), 200
        else:
            return jsonify({
                'status': 'error',
                'message': 'Delete failed'
            }), 400
    
    except Exception as e:
        return jsonify({'status': 'error', 'message': str(e)}), 500
