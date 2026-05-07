"""
User Management and Authentication
"""

from config.database import get_db_connection
import hashlib
import json


class UserManager:
    """User management dengan database MySQL"""
    
    @staticmethod
    def hash_password(password):
        """Hash password menggunakan SHA256"""
        return hashlib.sha256(password.encode()).hexdigest()
    
    @staticmethod
    def create_user(username, email, password, full_name=None):
        """
        Membuat user baru
        
        Returns:
        - user_id jika berhasil
        - None jika gagal
        """
        db = get_db_connection()
        
        try:
            # Check if user exists
            check_query = "SELECT user_id FROM users WHERE username=%s OR email=%s"
            existing = db.execute_query(check_query, (username, email))
            
            if existing:
                print("✗ Username atau Email sudah terdaftar")
                return None
            
            # Hash password
            password_hash = UserManager.hash_password(password)
            
            # Insert user
            query = """
                INSERT INTO users (username, email, password_hash, full_name)
                VALUES (%s, %s, %s, %s)
            """
            
            db.execute_update(query, (username, email, password_hash, full_name))
            
            # Get user_id
            user_query = "SELECT user_id FROM users WHERE username=%s"
            result = db.execute_query(user_query, (username,))
            
            if result:
                user_id = result[0]['user_id']
                print(f"✓ User '{username}' berhasil dibuat (ID: {user_id})")
                return user_id
            
        except Exception as e:
            print(f"✗ Error creating user: {e}")
            return None
        
        finally:
            db.disconnect()
    
    @staticmethod
    def authenticate(username, password):
        """
        Authenticate user
        
        Returns:
        - user_id jika berhasil
        - None jika gagal
        """
        db = get_db_connection()
        
        try:
            password_hash = UserManager.hash_password(password)
            
            query = """
                SELECT user_id, username, email FROM users 
                WHERE username=%s AND password_hash=%s
            """
            
            result = db.execute_query(query, (username, password_hash))
            
            if result:
                print(f"✓ Authentication successful untuk user '{username}'")
                return result[0]
            else:
                print(f"✗ Username atau password salah")
                return None
        
        except Exception as e:
            print(f"✗ Error authenticating: {e}")
            return None
        
        finally:
            db.disconnect()
    
    @staticmethod
    def get_user(user_id):
        """Mendapatkan info user"""
        db = get_db_connection()
        
        try:
            query = """
                SELECT user_id, username, email, full_name, created_at 
                FROM users WHERE user_id=%s
            """
            
            result = db.execute_query(query, (user_id,))
            
            return result[0] if result else None
        
        except Exception as e:
            print(f"✗ Error getting user: {e}")
            return None
        
        finally:
            db.disconnect()
    
    @staticmethod
    def update_user(user_id, **kwargs):
        """Update user information"""
        db = get_db_connection()
        
        try:
            allowed_fields = ['email', 'full_name']
            updates = {k: v for k, v in kwargs.items() if k in allowed_fields}
            
            if not updates:
                return False
            
            set_clause = ", ".join([f"{k}=%s" for k in updates.keys()])
            values = list(updates.values()) + [user_id]
            
            query = f"UPDATE users SET {set_clause} WHERE user_id=%s"
            db.execute_update(query, values)
            
            print(f"✓ User {user_id} updated")
            return True
        
        except Exception as e:
            print(f"✗ Error updating user: {e}")
            return False
        
        finally:
            db.disconnect()
    
    @staticmethod
    def delete_user(user_id):
        """Menghapus user"""
        db = get_db_connection()
        
        try:
            query = "DELETE FROM users WHERE user_id=%s"
            db.execute_update(query, (user_id,))
            
            print(f"✓ User {user_id} deleted")
            return True
        
        except Exception as e:
            print(f"✗ Error deleting user: {e}")
            return False
        
        finally:
            db.disconnect()
    
    @staticmethod
    def list_users():
        """Mendapatkan list semua users"""
        db = get_db_connection()
        
        try:
            query = """
                SELECT user_id, username, email, full_name, created_at 
                FROM users ORDER BY created_at DESC
            """
            
            return db.execute_query(query)
        
        except Exception as e:
            print(f"✗ Error listing users: {e}")
            return []
        
        finally:
            db.disconnect()
