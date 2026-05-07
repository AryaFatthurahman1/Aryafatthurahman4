"""
Machine Learning Classifier Models
"""

import joblib
import numpy as np
from sklearn.ensemble import RandomForestClassifier, GradientBoostingClassifier
from sklearn.linear_model import LogisticRegression
from sklearn.svm import SVC
from sklearn.metrics import accuracy_score, precision_score, recall_score, f1_score
import os


class MLClassifier:
    """Class untuk training dan prediction menggunakan classifier models"""
    
    def __init__(self, model_type='random_forest'):
        """
        Initialize classifier
        
        Parameters:
        - model_type: 'random_forest', 'gradient_boost', 'logistic_regression', 'svm'
        """
        self.model_type = model_type
        self.model = self._create_model()
        self.metrics = {}
    
    def _create_model(self):
        """Membuat model berdasarkan type"""
        if self.model_type == 'random_forest':
            return RandomForestClassifier(
                n_estimators=100,
                max_depth=10,
                random_state=42,
                n_jobs=-1
            )
        
        elif self.model_type == 'gradient_boost':
            return GradientBoostingClassifier(
                n_estimators=100,
                learning_rate=0.1,
                max_depth=5,
                random_state=42
            )
        
        elif self.model_type == 'logistic_regression':
            return LogisticRegression(
                max_iter=1000,
                random_state=42
            )
        
        elif self.model_type == 'svm':
            return SVC(
                kernel='rbf',
                probability=True,
                random_state=42
            )
        
        else:
            raise ValueError(f"Unknown model type: {self.model_type}")
    
    def train(self, X_train, y_train):
        """
        Train model
        
        Returns:
        - training_loss: loss value saat training
        """
        print(f"🔄 Training {self.model_type}...")
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
            'accuracy': accuracy_score(y_test, y_pred),
            'precision': precision_score(y_test, y_pred, average='weighted', zero_division=0),
            'recall': recall_score(y_test, y_pred, average='weighted', zero_division=0),
            'f1_score': f1_score(y_test, y_pred, average='weighted', zero_division=0)
        }
        
        print(f"✓ Accuracy: {self.metrics['accuracy']:.4f}")
        print(f"✓ Precision: {self.metrics['precision']:.4f}")
        print(f"✓ Recall: {self.metrics['recall']:.4f}")
        print(f"✓ F1-Score: {self.metrics['f1_score']:.4f}")
        
        return self.metrics
    
    def predict(self, X):
        """
        Melakukan prediksi
        
        Returns:
        - predictions: array of predictions
        - confidence: confidence scores
        """
        predictions = self.model.predict(X)
        
        # Get confidence scores
        if hasattr(self.model, 'predict_proba'):
            confidence = np.max(self.model.predict_proba(X), axis=1)
        else:
            confidence = np.ones_like(predictions)
        
        return predictions, confidence
    
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
