from flask import Flask, jsonify, request
from datetime import datetime

app = Flask(__name__)

# Mock data untuk testing
USERS = {
    1: {"user_id": 1, "username": "customer1", "email": "customer1@example.com", "full_name": "Budi Santoso"},
    2: {"user_id": 2, "username": "customer2", "email": "customer2@example.com", "full_name": "Siti Nurhaliza"},
}

PRODUCTS = {
    1: {"product_id": 1, "product_name": "Mie Instan Premium", "category_id": 1, "price": 2500, "stock": 100},
    2: {"product_id": 2, "product_name": "Kopi Instan", "category_id": 1, "price": 15000, "stock": 50},
    3: {"product_id": 3, "product_name": "Sampo Rambut", "category_id": 2, "price": 25000, "stock": 75},
    4: {"product_id": 4, "product_name": "Deodorant", "category_id": 2, "price": 18000, "stock": 60},
    5: {"product_id": 5, "product_name": "Powerbank 20000mAh", "category_id": 3, "price": 150000, "stock": 30},
}

CATEGORIES = {
    1: {"category_id": 1, "category_name": "Makanan & Minuman"},
    2: {"category_id": 2, "category_name": "Perawatan Diri"},
    3: {"category_id": 3, "category_name": "Elektronik & Gadget"},
}

@app.route('/')
def home():
    return jsonify({
        "status": "online",
        "message": "API Server Running",
        "timestamp": datetime.now().isoformat()
    })

# Auth endpoints
@app.route('/api/auth/login', methods=['POST'])
def login():
    data = request.json
    email = data.get('email')
    password = data.get('password')
    
    for user in USERS.values():
        if user['email'] == email:
            return jsonify({
                "success": True,
                "user": user,
                "token": "sample_token_" + str(user['user_id'])
            })
    
    return jsonify({"success": False, "message": "Invalid credentials"}), 401

@app.route('/api/auth/register', methods=['POST'])
def register():
    data = request.json
    return jsonify({
        "success": True,
        "message": "User registered successfully"
    })

# Products endpoints
@app.route('/api/products/list', methods=['GET'])
def products_list():
    page = request.args.get('page', 1, type=int)
    limit = request.args.get('limit', 10, type=int)
    
    products_list = list(PRODUCTS.values())
    offset = (page - 1) * limit
    paginated = products_list[offset:offset + limit]
    
    return jsonify({
        "success": True,
        "data": paginated,
        "pagination": {
            "page": page,
            "limit": limit,
            "total": len(products_list),
            "pages": (len(products_list) + limit - 1) // limit
        }
    })

@app.route('/api/products/detail/<int:product_id>', methods=['GET'])
def product_detail(product_id):
    product = PRODUCTS.get(product_id)
    if not product:
        return jsonify({"success": False, "message": "Product not found"}), 404
    
    return jsonify({
        "success": True,
        "data": product
    })

# Categories endpoints
@app.route('/api/categories', methods=['GET'])
def categories():
    return jsonify({
        "success": True,
        "data": list(CATEGORIES.values())
    })

# Shopping cart endpoints
@app.route('/api/cart/add', methods=['POST'])
def add_to_cart():
    data = request.json
    return jsonify({
        "success": True,
        "message": "Added to cart"
    })

@app.route('/api/cart/<int:user_id>', methods=['GET'])
def get_cart(user_id):
    return jsonify({
        "success": True,
        "data": [],
        "total": 0
    })

# Orders endpoints
@app.route('/api/orders/create', methods=['POST'])
def create_order():
    data = request.json
    order = {
        "order_id": 1,
        "order_number": "ORD-20240101-0001",
        "user_id": data.get('user_id'),
        "final_amount": 100000,
        "order_status": "pending",
        "created_at": datetime.now().isoformat()
    }
    return jsonify({
        "success": True,
        "order": order
    }), 201

@app.route('/api/orders/list/<int:user_id>', methods=['GET'])
def orders_list(user_id):
    return jsonify({
        "success": True,
        "data": []
    })

# Health check endpoint
@app.route('/api/health', methods=['GET'])
def health():
    return jsonify({
        "status": "ok",
        "message": "Server is running",
        "timestamp": datetime.now().isoformat()
    })

if __name__ == '__main__':
    print("=" * 80)
    print("🚀 ALFAMART API SERVER RUNNING!")
    print("=" * 80)
    print("\n📍 Server URL: http://localhost:5000")
    print("\n🔗 Available Endpoints:")
    print("   GET  /                           - Home/Status")
    print("   GET  /api/health                 - Health Check")
    print("   POST /api/auth/login             - Login")
    print("   POST /api/auth/register          - Register")
    print("   GET  /api/products/list          - Get Products")
    print("   GET  /api/products/detail/<id>   - Get Product Detail")
    print("   GET  /api/categories             - Get Categories")
    print("   POST /api/cart/add               - Add to Cart")
    print("   GET  /api/cart/<user_id>         - Get Cart")
    print("   POST /api/orders/create          - Create Order")
    print("   GET  /api/orders/list/<user_id>  - Get Orders")
    print("\n⏹️  Press CTRL+C to stop server")
    print("=" * 80)
    print()
    
    app.run(debug=True, host='0.0.0.0', port=5000)
