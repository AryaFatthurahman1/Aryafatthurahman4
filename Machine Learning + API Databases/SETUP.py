"""
SETUP.py - Automated Setup Script for Machine Learning + API Database Project
Initializes database and creates necessary directories
"""

import os
import sys
import mysql.connector
from mysql.connector import Error
from pathlib import Path
from dotenv import load_dotenv

# Load environment variables
load_dotenv('backend/.env')

class Setup:
    def __init__(self):
        self.db_host = os.getenv('DB_HOST', 'localhost')
        self.db_user = os.getenv('DB_USER', 'root')
        self.db_password = os.getenv('DB_PASSWORD', '')
        self.db_name = os.getenv('DB_NAME', 'ml_api_db')
        self.db_port = int(os.getenv('DB_PORT', 3306))
        
        self.connection = None
        
    def print_header(self):
        """Print setup header"""
        print("""
        ╔════════════════════════════════════════════════╗
        ║  Machine Learning + API Database Setup        ║
        ║  Automated Configuration & Initialization     ║
        ╚════════════════════════════════════════════════╝
        """)
    
    def connect_to_mysql(self):
        """Connect to MySQL server"""
        try:
            print("📡 Connecting to MySQL Server...")
            self.connection = mysql.connector.connect(
                host=self.db_host,
                user=self.db_user,
                password=self.db_password,
                port=self.db_port,
                autocommit=True
            )
            print(f"✓ Successfully connected to MySQL")
            return True
        except Error as e:
            print(f"✗ MySQL Connection Error: {e}")
            print(f"  Host: {self.db_host}:{self.db_port}")
            print(f"  User: {self.db_user}")
            return False
    
    def create_database(self):
        """Create database if not exists"""
        try:
            cursor = self.connection.cursor()
            print(f"\n📦 Creating database '{self.db_name}'...")
            
            query = f"""
                CREATE DATABASE IF NOT EXISTS {self.db_name}
                CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci
            """
            cursor.execute(query)
            print(f"✓ Database '{self.db_name}' ready")
            cursor.close()
            return True
        except Error as e:
            print(f"✗ Database Creation Error: {e}")
            return False
    
    def import_schema(self):
        """Import SQL schema"""
        try:
            schema_path = Path('database/sql/schema.sql')
            
            if not schema_path.exists():
                print(f"✗ Schema file not found: {schema_path}")
                return False
            
            print(f"\n📋 Importing schema from {schema_path}...")
            
            # Read SQL file
            with open(schema_path, 'r', encoding='utf-8') as f:
                sql_content = f.read()
            
            # Connect to the database
            db_connection = mysql.connector.connect(
                host=self.db_host,
                user=self.db_user,
                password=self.db_password,
                database=self.db_name,
                port=self.db_port,
                autocommit=True
            )
            
            cursor = db_connection.cursor()
            
            # Split and execute statements
            statements = sql_content.split(';')
            for statement in statements:
                statement = statement.strip()
                if statement:
                    try:
                        cursor.execute(statement)
                    except Error as e:
                        # Skip some expected errors
                        if "already exists" not in str(e).lower():
                            print(f"  ⚠ Warning: {e}")
            
            print("✓ Schema imported successfully")
            cursor.close()
            db_connection.close()
            return True
            
        except Error as e:
            print(f"✗ Schema Import Error: {e}")
            return False
    
    def create_directories(self):
        """Create necessary directories"""
        print("\n📁 Creating project directories...")
        
        directories = [
            'backend/models',
            'backend/data',
            'backend/uploads',
            'backend/logs'
        ]
        
        for directory in directories:
            try:
                Path(directory).mkdir(parents=True, exist_ok=True)
                print(f"✓ {directory}")
            except Exception as e:
                print(f"✗ Failed to create {directory}: {e}")
        
        return True
    
    def create_env_file(self):
        """Create .env file from .env.example if not exists"""
        env_path = Path('backend/.env')
        env_example_path = Path('backend/.env.example')
        
        print("\n⚙️  Configuring environment...")
        
        if not env_path.exists():
            try:
                with open(env_example_path, 'r') as f:
                    content = f.read()
                with open(env_path, 'w') as f:
                    f.write(content)
                print(f"✓ Created .env from .env.example")
            except Exception as e:
                print(f"✗ Failed to create .env: {e}")
                return False
        else:
            print(f"✓ .env already exists")
        
        return True
    
    def show_summary(self):
        """Show setup summary"""
        print("""
        ╔════════════════════════════════════════════════╗
        ║  Setup Complete! 🎉                            ║
        ╚════════════════════════════════════════════════╝
        
        📋 Next Steps:
        
        1️⃣  Navigate to backend directory:
            cd backend
        
        2️⃣  Start the API server:
            python app.py
        
        3️⃣  Open dashboard in browser:
            http://localhost:8080 (Laragon Server)
            http://localhost:5000/api (API)
        
        4️⃣  Manage database:
            http://localhost/phpmyadmin
        
        ═════════════════════════════════════════════════
        
        📊 Database Info:
            Host: """ + self.db_host + """
            Port: """ + str(self.db_port) + """
            Name: """ + self.db_name + """
        
        ═════════════════════════════════════════════════
        """)
    
    def run(self):
        """Run complete setup"""
        self.print_header()
        
        # Step 1: Connect to MySQL
        if not self.connect_to_mysql():
            print("\n❌ Cannot proceed without MySQL connection")
            return False
        
        # Step 2: Create database
        if not self.create_database():
            print("\n❌ Cannot proceed without database")
            return False
        
        # Step 3: Import schema
        if not self.import_schema():
            print("\n⚠️  Schema import had issues, but continuing...")
        
        # Step 4: Create directories
        self.create_directories()
        
        # Step 5: Create .env
        self.create_env_file()
        
        # Step 6: Close connection
        if self.connection:
            self.connection.close()
        
        # Show summary
        self.show_summary()
        
        print("✅ Setup completed successfully!\n")
        return True

if __name__ == '__main__':
    setup = Setup()
    success = setup.run()
    
    input("Press Enter to exit...")
    sys.exit(0 if success else 1)
