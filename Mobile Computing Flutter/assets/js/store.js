const cart = new Map();

function formatRupiah(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(Number(value || 0));
}

function escapeHtml(value) {
    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function syncCartView() {
    const cartList = document.getElementById('cartList');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');

    if (!cartList || !cartCount || !cartTotal) {
        return;
    }

    const items = Array.from(cart.values());
    const count = items.reduce((sum, item) => sum + item.qty, 0);
    const total = items.reduce((sum, item) => sum + (item.qty * item.price), 0);

    cartCount.textContent = count;
    cartTotal.textContent = formatRupiah(total);

    if (items.length === 0) {
        cartList.innerHTML = '<p class="small-text">Belum ada item dipilih.</p>';
        return;
    }

    cartList.innerHTML = items.map((item) => `
        <div class="cart-row">
            <div>
                <strong>${escapeHtml(item.name)}</strong>
                <span>${escapeHtml(item.sku)} | ${formatRupiah(item.price)}</span>
            </div>
            <div class="mini-actions">
                <button type="button" class="ghost-button" data-action="decrease" data-id="${item.id}">-</button>
                <span>${item.qty}</span>
                <button type="button" class="ghost-button" data-action="increase" data-id="${item.id}">+</button>
            </div>
        </div>
    `).join('');
}

function addToCart(product) {
    const existing = cart.get(product.id) || { ...product, qty: 0 };
    existing.qty += 1;
    cart.set(product.id, existing);
    syncCartView();
}

function changeQty(id, delta) {
    const item = cart.get(id);
    if (!item) {
        return;
    }

    item.qty += delta;
    if (item.qty <= 0) {
        cart.delete(id);
    } else {
        cart.set(id, item);
    }
    syncCartView();
}

async function refreshProducts() {
    const productGrid = document.getElementById('productGrid');
    if (!productGrid) {
        return;
    }

    productGrid.innerHTML = '<p class="small-text">Memuat data terbaru dari API...</p>';

    try {
        const response = await fetch('api/products/list.php?featured=1&limit=8');
        const result = await response.json();

        if (!result.success) {
            throw new Error(result.message || 'Gagal mengambil data produk.');
        }

        const cards = result.data.products.map((product) => `
            <article
                class="product-card"
                data-product-id="${Number(product.product_id)}"
                data-product-name="${escapeHtml(product.product_name)}"
                data-product-sku="${escapeHtml(product.sku)}"
                data-product-price="${Number(product.price)}"
            >
                <div class="product-top">
                    <span class="chip">${escapeHtml(product.category_name)}</span>
                    <span class="rating">Rating ${Number(product.rating || 0).toFixed(1)}</span>
                </div>
                <h3>${escapeHtml(product.product_name)}</h3>
                <p class="sku">SKU: ${escapeHtml(product.sku)}</p>
                <p class="price">${formatRupiah(product.price)}</p>
                <p class="stock">Stok: ${Number(product.stock)} unit</p>
                <button class="add-cart-button" type="button">Tambah ke keranjang</button>
            </article>
        `).join('');

        productGrid.innerHTML = cards || '<p class="small-text">Belum ada produk untuk ditampilkan.</p>';
        attachCardActions();
    } catch (error) {
        productGrid.innerHTML = `<p class="small-text">${escapeHtml(error.message)}</p>`;
    }
}

function attachCardActions() {
    document.querySelectorAll('.product-card').forEach((card) => {
        const button = card.querySelector('.add-cart-button');
        if (!button) return;

        button.addEventListener('click', () => {
            addToCart({
                id: Number(card.dataset.productId),
                name: card.dataset.productName,
                sku: card.dataset.productSku,
                price: Number(card.dataset.productPrice),
            });
        });
    });
}

document.addEventListener('click', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLElement)) {
        return;
    }

    const action = target.dataset.action;
    const id = Number(target.dataset.id);
    if (!action || !id) {
        return;
    }

    if (action === 'increase') {
        changeQty(id, 1);
    }

    if (action === 'decrease') {
        changeQty(id, -1);
    }
});

const refreshButton = document.getElementById('refreshProducts');
if (refreshButton) {
    refreshButton.addEventListener('click', refreshProducts);
}

const clearButton = document.getElementById('clearCart');
if (clearButton) {
    clearButton.addEventListener('click', () => {
        cart.clear();
        syncCartView();
    });
}

const checkoutButton = document.getElementById('checkoutButton');
if (checkoutButton) {
    checkoutButton.addEventListener('click', syncCartView);
}

syncCartView();
