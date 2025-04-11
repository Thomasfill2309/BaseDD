document.addEventListener('DOMContentLoaded', function() {
    // Cargar productos
    fetchProducts();
    
    // Configurar eventos
    setupEventListeners();
});

function fetchProducts() {
    fetch('api/products.php')
        .then(response => response.json())
        .then(products => {
            renderProducts(products);
        })
        .catch(error => console.error('Error:', error));
}

function renderProducts(products) {
    const productsContainer = document.querySelector('.productos');
    productsContainer.innerHTML = '';
    
    products.forEach(product => {
        const productElement = document.createElement('div');
        productElement.className = 'producto';
        productElement.dataset.id = product.id;
        
        productElement.innerHTML = `
            <img src="${product.imagen || 'https://via.placeholder.com/150'}" alt="${product.nombre}">
            <h3>${product.nombre}</h3>
            <p>${product.descripcion}</p>
            <p>Precio: $${product.precio}</p>
            <button class="add-to-cart">Comprar</button>
            <div class="admin-actions" style="display: none;">
                <button class="edit-product">Editar</button>
                <button class="delete-product">Eliminar</button>
            </div>
        `;
        
        productsContainer.appendChild(productElement);
    });
}

function setupEventListeners() {
    // Agregar al carrito
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart')) {
            const productId = e.target.closest('.producto').dataset.id;
            addToCart(productId);
        }
    });
}

function addToCart(productId) {
    fetch('api/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ producto_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        alert('Producto agregado al carrito');
        updateCartCount();
    })
    .catch(error => console.error('Error:', error));
}

function updateCartCount() {
    fetch('api/cart.php')
        .then(response => response.json())
        .then(cart => {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.textContent = cart.reduce((total, item) => total + item.cantidad, 0);
            }
        });
}