"""
Machine Learning Regression Models
"""

import joblib
import numpy as np
from sklearn.ensemble import RandomForestRegressor, GradientBoostingRegressor
from sklearn.linear_model import LinearRegression, Ridge, Lasso
from sklearn.metrics import mean_squared_error, r2_score, mean_absolute_error
import os


class MLRegressor:
    """Class untuk training dan prediction menggunakan regression models"""
    
    def __init__(self, model_type='random_forest'):
        """
        Initialize regressor
        
        Parameters:
        - model_type: 'random_forest', 'gradient_boost', 'linear', 'ridge', 'lasso'
        """
        self.model_type = model_type
        self.model = self._create_model()
        self.metrics = {}
    
    def _create_model(self):
        """Membuat model berdasarkan type"""
        if self.model_type == 'random_forest':
            return RandomForestRegressor(
                n_estimators=100,
                max_depth=10,
                random_state=42,
                n_jobs=-1
            )
        
        elif self.model_type == 'gradient_boost':
            return GradientBoostingRegressor(
                n_estimators=100,
                learning_rate=0.1,
                max_depth=5,
                random_state=42
            )
        
        elif self.model_type == 'linear':
            return LinearRegression()
        
        elif self.model_type == 'ridge':
            return Ridge(alpha=1.0)
        
        elif self.model_type == 'lasso':
            return Lasso(alpha=0.1)
        
        else:
            raise ValueError(f"Unknown model type: {self.model_type}")
    
    def train(self, X_train, y_train):
        """Train model"""
        print(f"🔄 Training {self.model_type} Regressor...")
        self.model.fit(X_train, y_train)
        print(f"✓ Training selesai!")
        return True
    
    def evaluate(self, X_test, y_test):
        """
        Evaluasi model
        
        Returns:
        - Metrics dict
        """
        print(f"📊 Evaluating model...")
        
        y_pred = self.model.predict(X_test)
        
        self.metrics = {
            'mse': mean_squared_error(y_test, y_pred),
            'rmse': np.sqrt(mean_squared_error(y_test, y_pred)),
            'mae': mean_absolute_error(y_test, y_pred),
            'r2_score': r2_score(y_test, y_pred)
        }
        
        print(f"✓ RMSE: {self.metrics['rmse']:.4f}")
        print(f"✓ MAE: {self.metrics['mae']:.4f}")
        print(f"✓ R² Score: {self.metrics['r2_score']:.4f}")
        
        return self.metrics
    
    def predict(self, X):
        """
        Melakukan prediksi
        
        Returns:
        - predictions: array of predictions
        """
        predictions = self.model.predict(X)
        return predictions
    
    def save_model(self, filepath):
        """Menyimpan model ke file"""
        os.makedirs(os.path.dirname(filepath), exist_ok=True)
        joblib.dump(self.model, filepath)
        print(f"✓ Model tersimpan: {filepath}")
    
    def load_model(self, filepath):
        """Memuat model dari file"""
        self.model = joblib.load(filepath)
        print(f"✓ Model dimuat: {filepath}")
    
    def get_feature_importance(self):
        """Mendapatkan feature importance"""
        if hasattr(self.model, 'feature_importances_'):
            return self.model.feature_importances_
        else:
            return None
