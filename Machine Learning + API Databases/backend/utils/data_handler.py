"""
Data Handler untuk processing data dari MySQL
"""

import pandas as pd
import numpy as np
from sklearn.preprocessing import StandardScaler, MinMaxScaler
from sklearn.model_selection import train_test_split
from config.database import get_db_connection
import json


class DataHandler:
    """Class untuk handle data dari MySQL"""
    
    @staticmethod
    def get_dataset_from_db(dataset_id):
        """Membaca data dari database"""
        db = get_db_connection()
        
        try:
            # Query data berdasarkan dataset_id
            query = f"SELECT * FROM dataset_records WHERE dataset_id = %s"
            data = db.execute_query(query, (dataset_id,))
            
            if data:
                df = pd.DataFrame(data)
                return df
            return None
        
        finally:
            db.disconnect()
    
    @staticmethod
    def preprocess_data(df, test_size=0.2, scale=True):
        """
        Preprocessing data
        
        Parameters:
        - df: DataFrame
        - test_size: proporsi test set
        - scale: apakah melakukan scaling
        """
        
        # Handle missing values
        df = df.fillna(df.mean(numeric_only=True))
        
        # Separate features dan target
        X = df.drop(columns=['target'], errors='ignore')
        y = df.get('target', None)
        
        # Split data
        if y is not None:
            X_train, X_test, y_train, y_test = train_test_split(
                X, y, test_size=test_size, random_state=42
            )
        else:
            X_train, X_test = train_test_split(
                X, test_size=test_size, random_state=42
            )
            y_train = y_test = None
        
        # Scaling jika diperlukan
        if scale:
            scaler = StandardScaler()
            X_train = scaler.fit_transform(X_train)
            X_test = scaler.transform(X_test)
        
        return X_train, X_test, y_train, y_test
    
    @staticmethod
    def save_prediction_to_db(model_id, user_id, input_data, prediction, confidence):
        """Menyimpan hasil prediksi ke database"""
        db = get_db_connection()
        
        try:
            query = """
                INSERT INTO predictions 
                (model_id, user_id, input_data, predicted_value, confidence)
                VALUES (%s, %s, %s, %s, %s)
            """
            
            input_json = json.dumps(input_data)
            db.execute_update(query, (
                model_id, user_id, input_json, 
                str(prediction), float(confidence)
            ))
            
            print(f"✓ Prediksi tersimpan dengan confidence: {confidence}")
            return True
        
        except Exception as e:
            print(f"✗ Error saving prediction: {e}")
            return False
        
        finally:
            db.disconnect()
    
    @staticmethod
    def log_api_call(user_id, endpoint, method, request_data, response_code, exec_time):
        """Mencatat API call ke database"""
        db = get_db_connection()
        
        try:
            query = """
                INSERT INTO api_logs 
                (user_id, endpoint, method, request_data, response_code, execution_time_ms)
                VALUES (%s, %s, %s, %s, %s, %s)
            """
            
            request_json = json.dumps(request_data)
            db.execute_update(query, (
                user_id, endpoint, method, request_json, response_code, exec_time
            ))
            
        except Exception as e:
            print(f"✗ Error logging API call: {e}")
        
        finally:
            db.disconnect()
