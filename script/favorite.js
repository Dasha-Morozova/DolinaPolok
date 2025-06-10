document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
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
});

document.querySelectorAll('.delete-favorite-product').forEach(button => {
    button.addEventListener('click', function () {
        const product_id = this.getAttribute('data-product-id'); 
    
    
        fetch(`/handlers/favorite_pr.php?product_id=${product_id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
             
        })
        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                
                console.log(data.message);
                
            } else {
                console.error('Ошибка: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            
        });
    location.reload();
    console.log(1);   
    });


});

