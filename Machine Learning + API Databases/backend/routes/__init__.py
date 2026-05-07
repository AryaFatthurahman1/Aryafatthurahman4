"""
Routes Package
"""

from .models import model_routes
from .predictions import prediction_routes
from .users import user_routes

__all__ = ['model_routes', 'prediction_routes', 'user_routes']
