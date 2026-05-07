"""
Database Configuration untuk MySQL di Laragon
"""

import mysql.connector
from mysql.connector import Error
import os
from dotenv import load_dotenv

load_dotenv()

class DatabaseConfig:
    """Konfigurasi Database MySQL"""
    
    # Konfigurasi untuk Laragon
    DB_HOST = os.getenv('DB_HOST', 'localhost')
    DB_USER = os.getenv('DB_USER', 'root')
    DB_PASSWORD = os.getenv('DB_PASSWORD', '')
    DB_NAME = os.getenv('DB_NAME', 'ml_api_db')
    DB_PORT = int(os.getenv('DB_PORT', 3306))


class MySQLConnection:
    """Class untuk mengelola koneksi MySQL"""
    
    def __init__(self):
        self.connection = None
        self.cursor = None
    
    def connect(self):
        """Membuat koneksi ke MySQL"""
        try:
            self.connection = mysql.connector.connect(
                host=DatabaseConfig.DB_HOST,
                user=DatabaseConfig.DB_USER,
                password=DatabaseConfig.DB_PASSWORD,
                database=DatabaseConfig.DB_NAME,
                port=DatabaseConfig.DB_PORT,
                autocommit=True
            )
            
            if self.connection.is_connected():
                self.cursor = self.connection.cursor(dictionary=True)
                print(f"✓ Berhasil terhubung ke database: {DatabaseConfig.DB_NAME}")
                return True
        
        except Error as e:
            print(f"✗ Error koneksi database: {e}")
            return False
    
    def disconnect(self):
        """Menutup koneksi MySQL"""
        if self.connection and self.connection.is_connected():
            self.cursor.close()
            self.connection.close()
            print("✓ Koneksi database ditutup")
    
    def execute_query(self, query, params=None):
        """Menjalankan query SELECT"""
        try:
            if params:
                self.cursor.execute(query, params)
            else:
                self.cursor.execute(query)
            return self.cursor.fetchall()
        except Error as e:
            print(f"✗ Error query: {e}")
            return None
    
    def execute_update(self, query, params=None):
        """Menjalankan query INSERT, UPDATE, DELETE"""
        try:
            if params:
                self.cursor.execute(query, params)
            else:
                self.cursor.execute(query)
            self.connection.commit()
            return self.cursor.rowcount
        except Error as e:
            print(f"✗ Error update: {e}")
            self.connection.rollback()
            return 0
    
    def execute_many(self, query, data_list):
        """Menjalankan query batch INSERT/UPDATE"""
        try:
            self.cursor.executemany(query, data_list)
            self.connection.commit()
            return self.cursor.rowcount
        except Error as e:
            print(f"✗ Error batch: {e}")
            self.connection.rollback()
            return 0


# Fungsi helper
def get_db_connection():
    """Mendapatkan koneksi database"""
    db = MySQLConnection()
    db.connect()
    return db
