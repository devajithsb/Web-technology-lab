// ============================================
// PRODUCT DATA WITH WORKING IMAGES
// ============================================
const products = [
    // Shirts
    { 
        id: 1, 
        name: "Vintage Flannel Shirt", 
        price: 45, 
        oldPrice: 65, 
        rating: 4.5, 
        category: "shirts", 
        size: "M", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 2, 
        name: "Retro Bowling Shirt", 
        price: 55, 
        oldPrice: 80, 
        rating: 4, 
        category: "shirts", 
        size: "L", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1589310243380-26a1d4abec3e?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 3, 
        name: "Classic Oxford Shirt", 
        price: 35, 
        oldPrice: null, 
        rating: 4.5, 
        category: "shirts", 
        size: "S", 
        badge: null, 
        image: "https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 4, 
        name: "Denim Western Shirt", 
        price: 65, 
        oldPrice: 95, 
        rating: 5, 
        category: "shirts", 
        size: "XL", 
        badge: "sale", 
        image: "https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop&crop=center" 
    },
    
    // T-Shirts
    { 
        id: 5, 
        name: "Vintage Band T-Shirt", 
        price: 28, 
        oldPrice: 40, 
        rating: 4.5, 
        category: "t-shirts", 
        size: "M", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 6, 
        name: "Graphic Tee - 90s Style", 
        price: 25, 
        oldPrice: null, 
        rating: 4, 
        category: "t-shirts", 
        size: "L", 
        badge: null, 
        image: "https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 7, 
        name: "Pocket Tee - Vintage Wash", 
        price: 32, 
        oldPrice: 45, 
        rating: 4.5, 
        category: "t-shirts", 
        size: "S", 
        badge: "sale", 
        image: "https://images.unsplash.com/photo-1581655353564-df123a1eb820?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 8, 
        name: "Retro Logo T-Shirt", 
        price: 30, 
        oldPrice: null, 
        rating: 4, 
        category: "t-shirts", 
        size: "XL", 
        badge: null, 
        image: "https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&h=300&fit=crop&crop=center" 
    },
    
    // Baggy Pants
    { 
        id: 9, 
        name: "Baggy Cargo Pants", 
        price: 65, 
        oldPrice: 85, 
        rating: 4.5, 
        category: "baggy-pants", 
        size: "L", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1584865288642-42078afe6942?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 10, 
        name: "Wide Leg Trousers", 
        price: 55, 
        oldPrice: null, 
        rating: 4, 
        category: "baggy-pants", 
        size: "M", 
        badge: null, 
        image: "https://images.unsplash.com/photo-1584865288642-42078afe6942?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 11, 
        name: "Parachute Pants - Vintage", 
        price: 75, 
        oldPrice: 110, 
        rating: 5, 
        category: "baggy-pants", 
        size: "XL", 
        badge: "sale", 
        image: "https://images.unsplash.com/photo-1584865288642-42078afe6942?w=400&h=300&fit=crop&crop=center" 
    },
    
    // Jeans
    { 
        id: 12, 
        name: "Vintage Levi's 501", 
        price: 85, 
        oldPrice: 120, 
        rating: 5, 
        category: "jeans", 
        size: "32", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 13, 
        name: "Baggy Jeans - 90s Style", 
        price: 70, 
        oldPrice: 100, 
        rating: 4.5, 
        category: "jeans", 
        size: "34", 
        badge: "sale", 
        image: "https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 14, 
        name: "Distressed Denim", 
        price: 60, 
        oldPrice: null, 
        rating: 4, 
        category: "jeans", 
        size: "30", 
        badge: null, 
        image: "https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&h=300&fit=crop&crop=center" 
    },
    
    // Vintage
    { 
        id: 15, 
        name: "Vintage Leather Jacket", 
        price: 120, 
        oldPrice: 180, 
        rating: 5, 
        category: "vintage", 
        size: "L", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400&h=300&fit=crop&crop=center" 
    },
    { 
        id: 16, 
        name: "70s Retro Blazer", 
        price: 95, 
        oldPrice: 140, 
        rating: 4.5, 
        category: "vintage", 
        size: "M", 
        badge: "vintage", 
        image: "https://images.unsplash.com/photo-1551028719-00167b16eac5?w=400&h=300&fit=crop&crop=center" 
    }
];

// ============================================
// STATE MANAGEMENT
// ============================================
let cart = [];
let wishlist = [];
let currentFilter = 'all';
let displayedProducts = 8;

// ============================================
// DOM ELEMENTS
// ============================================
const productsGrid = document.getElementById('productsGrid');
const cartItems = document.getElementById('cartItems');
const wishlistItems = document.getElementById('wishlistItems');
const cartCount = document.getElementById('cartCount');
const wishlistCount = document.getElementById('wishlistCount');
const cartTotal = document.getElementById('cartTotal');
const searchInput = document.getElementById('searchInput');
const sortSelect = document.getElementById('sortSelect');

// ============================================
// RENDER PRODUCTS
// ============================================
function renderProducts(filter = 'all', search = '') {
    let filtered = [...products];
    
    if (filter !== 'all') {
        filtered = filtered.filter(p => p.category === filter);
    }
    
    if (search) {
        filtered = filtered.filter(p => 
            p.name.toLowerCase().includes(search.toLowerCase())
        );
    }
    
    // Sort
    const sortValue = sortSelect.value;
    if (sortValue === 'price-low') {
        filtered.sort((a, b) => a.price - b.price);
    } else if (sortValue === 'price-high') {
        filtered.sort((a, b) => b.price - a.price);
    }
    
    // Limit displayed
    const display = filtered.slice(0, displayedProducts);
    
    if (display.length === 0) {
        productsGrid.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                <p style="font-size: 18px; color: #999;">No products found</p>
            </div>
        `;
        return;
    }
    
    productsGrid.innerHTML = display.map(product => {
        const isInWishlist = wishlist.find(p => p.id === product.id);
        const ratingStars = '★'.repeat(Math.floor(product.rating)) + '☆'.repeat(5 - Math.floor(product.rating));
        
        let badgeHTML = '';
        if (product.badge === 'vintage') {
            badgeHTML = '<span class="badge vintage">✨ Vintage</span>';
        } else if (product.badge === 'sale') {
            badgeHTML = '<span class="badge sale">🔥 Sale</span>';
        }
        
        return `
            <div class="product-card" data-id="${product.id}">
                <div class="image-wrap">
                    <img src="${product.image}" alt="${product.name}" onerror="this.src='https://via.placeholder.com/400x300/1a1a1a/ffd200?text=ThriftVibe'" />
                    ${badgeHTML}
                    <button class="wishlist-btn" onclick="toggleWishlist(${product.id})">
                        <i class="${isInWishlist ? 'fas' : 'far'} fa-heart"></i>
                    </button>
                </div>
                <div class="product-info">
                    <div class="category-tag">${product.category}</div>
                    <h3>${product.name}</h3>
                    <div class="rating">${ratingStars} ${product.rating}</div>
                    <div class="price">
                        $${product.price}
                        ${product.oldPrice ? `<span class="old">$${product.oldPrice}</span>` : ''}
                    </div>
                    <span class="size-tag">Size: ${product.size}</span>
                    <div class="product-actions">
                        <button class="btn-cart" onclick="addToCart(${product.id})">
                            <i class="fas fa-shopping-bag"></i> Add
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// ============================================
// CART FUNCTIONS
// ============================================
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const existing = cart.find(p => p.id === productId);
    
    if (existing) {
        existing.quantity++;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    
    updateCart();
    showNotification('Added to cart! 🛒');
}

function removeFromCart(productId) {
    cart = cart.filter(p => p.id !== productId);
    updateCart();
}

function updateQuantity(productId, change) {
    const item = cart.find(p => p.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
            return;
        }
        updateCart();
    }
}

function updateCart() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
    
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartTotal.textContent = `$${total.toFixed(2)}`;
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="empty-msg">Your cart is empty</p>';
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/70x70/1a1a1a/ffd200?text=Thrift'" />
                <div class="cart-item-details">
                    <h4>${item.name}</h4>
                    <span class="size">Size: ${item.size}</span>
                    <p>$${item.price}</p>
                </div>
                <div class="cart-item-qty">
                    <button onclick="updateQuantity(${item.id}, -1)">−</button>
                    <span>${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, 1)">+</button>
                </div>
                <span class="remove-item" onclick="removeFromCart(${item.id})">&times;</span>
            </div>
        `).join('');
    }
}

// ============================================
// WISHLIST FUNCTIONS
// ============================================
function toggleWishlist(productId) {
    const index = wishlist.findIndex(p => p.id === productId);
    
    if (index > -1) {
        wishlist.splice(index, 1);
        showNotification('Removed from wishlist 💔');
    } else {
        const product = products.find(p => p.id === productId);
        wishlist.push(product);
        showNotification('Added to wishlist ❤️');
    }
    
    updateWishlist();
    renderProducts(currentFilter, searchInput.value);
}

function removeFromWishlist(productId) {
    wishlist = wishlist.filter(p => p.id !== productId);
    updateWishlist();
    renderProducts(currentFilter, searchInput.value);
}

function updateWishlist() {
    wishlistCount.textContent = wishlist.length;
    
    if (wishlist.length === 0) {
        wishlistItems.innerHTML = '<p class="empty-msg">Your wishlist is empty</p>';
    } else {
        wishlistItems.innerHTML = wishlist.map(item => `
            <div class="wishlist-item">
                <img src="${item.image}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/70x70/1a1a1a/ffd200?text=Thrift'" />
                <div class="cart-item-details">
                    <h4>${item.name}</h4>
                    <span class="size">Size: ${item.size}</span>
                    <p>$${item.price}</p>
                </div>
                <button class="btn-cart" onclick="addToCart(${item.id})" style="padding: 8px 16px; border: none; border-radius: 8px; cursor: pointer; background: linear-gradient(135deg, #f7971e, #ffd200); font-weight: 700;">
                    <i class="fas fa-shopping-bag"></i>
                </button>
                <span class="remove-item" onclick="removeFromWishlist(${item.id})">&times;</span>
            </div>
        `).join('');
    }
}

// ============================================
// PANEL FUNCTIONS
// ============================================
function openCart() {
    document.getElementById('cartPanel').classList.add('active');
}

function closeCart() {
    document.getElementById('cartPanel').classList.remove('active');
}

function openWishlist() {
    document.getElementById('wishlistPanel').classList.add('active');
}

function closeWishlist() {
    document.getElementById('wishlistPanel').classList.remove('active');
}

// Click handlers
document.querySelector('.icon-link[href="#cart"]').addEventListener('click', (e) => {
    e.preventDefault();
    openCart();
});

document.querySelector('.icon-link[href="#wishlist"]').addEventListener('click', (e) => {
    e.preventDefault();
    openWishlist();
});

// ============================================
// CHECKOUT
// ============================================
function checkout() {
    if (cart.length === 0) {
        showNotification('Your cart is empty! 🛒');
        return;
    }
    
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    alert(`Thank you for your order! 🎉\nTotal: $${total.toFixed(2)}`);
    cart = [];
    updateCart();
    closeCart();
}

// ============================================
// NOTIFICATION
// ============================================
function showNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #1a1a1a;
        color: #ffd200;
        padding: 15px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        z-index: 2000;
        animation: slideUp 0.3s ease;
        font-weight: 600;
        border: 1px solid #ffd200;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.3s';
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// ============================================
// FILTER & SEARCH
// ============================================
// Filter buttons
document.querySelectorAll('.nav a').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelectorAll('.nav a').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.dataset.filter;
        displayedProducts = 8;
        renderProducts(currentFilter, searchInput.value);
    });
});

// Category cards
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('click', () => {
        const category = card.dataset.category;
        const navBtn = document.querySelector(`.nav a[data-filter="${category}"]`);
        if (navBtn) {
            document.querySelectorAll('.nav a').forEach(b => b.classList.remove('active'));
            navBtn.classList.add('active');
            currentFilter = category;
            displayedProducts = 8;
            renderProducts(currentFilter, searchInput.value);
        }
        document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
    });
});

// Search
searchInput.addEventListener('input', () => {
    displayedProducts = 8;
    renderProducts(currentFilter, searchInput.value);
});

document.getElementById('searchBtn').addEventListener('click', () => {
    displayedProducts = 8;
    renderProducts(currentFilter, searchInput.value);
    document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
});

searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        displayedProducts = 8;
        renderProducts(currentFilter, searchInput.value);
        document.getElementById('products').scrollIntoView({ behavior: 'smooth' });
    }
});

// Sort
sortSelect.addEventListener('change', () => {
    renderProducts(currentFilter, searchInput.value);
});

// ============================================
// INITIALIZE
// ============================================
renderProducts();
updateCart();
updateWishlist();

// Add style for notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        from { opacity: 0; transform: translateX(-50%) translateY(20px); }
        to { opacity: 1; transform: translateX(-50%) translateY(0); }
    }
`;
document.head.appendChild(style);