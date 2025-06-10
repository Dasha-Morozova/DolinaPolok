function updateMainPhoto(src) {
    document.getElementById('mainPhoto').src = src;
}

document.getElementById('add-to-cart').addEventListener('click', function () {
    const product_id = this.getAttribute('data-product-id'); 


    fetch('/handlers/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product_id: product_id }), 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            
            console.log(data.message);
            //updateCartCount(data.cart_count);
        } else {
            console.error('Ошибка: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        
    });
});

//  для обновления количества товаров в корзине
function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
}

document.getElementById('add-to-favorites').addEventListener('click', function () {
    const product_id = this.getAttribute('data-product-id'); 


    fetch('/handlers/favorite_pr.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product_id: product_id }), 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            
            console.log(data.message);
            //updateCartCount(data.cart_count);
        } else {
            console.error('Ошибка: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        
    });
});
