// обновление общей суммы
function updateTotalSum() {
    let totalSum = 0;

    // Перебираем все поля ввода количества
    document.querySelectorAll('.quantity-input').forEach(input => {
        const price = parseFloat(input.getAttribute('data-price')); 
        const quantity = parseInt(input.value); 
        totalSum += price * quantity; 
        let localTotalSum = quantity * price;
        const productId = input.getAttribute('data-product-id');
      
        document.querySelector(`.local-total-sum[data-product-id="${productId}"]`).textContent = localTotalSum.toFixed(2) ; //
    });
    
    // Обновляем итоговую сумму на странице
    document.getElementById('total-sum').textContent = totalSum.toFixed(2);
}

// Обработчики событий для кнопок "+" и "-"
document.querySelectorAll('.increment').forEach(button => {
    button.addEventListener('click', function () {
        const input = this.parentElement.querySelector('.quantity-input');
        input.value = parseInt(input.value) + 1; // Увеличиваем количество
        updateTotalSum(); 
        updateCount(input);
    });
});

document.querySelectorAll('.decrement').forEach(button => {
    button.addEventListener('click', function () {
        const input = this.parentElement.querySelector('.quantity-input');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1; // Уменьшаем количество
            updateTotalSum(); 
            updateCount(input);
        }
    });
});

// Обработчик события для изменения значения в поле ввода
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function () {
        if (this.value < 0) this.value = 0; 
        updateTotalSum(); 
    });
});

let timeout;

//  отправка запроса на сервер
function updateCount(input) {
    const productId = input.getAttribute('data-product-id');
    const quantity = input.value;
    

    fetch('/handlers/update_carted_product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: productId, quantity: quantity })
    }).then(response => response.json())
      .then(data => console.log('Updated:', data))
      .catch(error => console.error('Error:', error));
      
}

// Обработчик изменения количества с debounce (задержка 500 мс)
document.querySelectorAll('.quantity-input').forEach(input => {
    console.log("11");
    input.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            updateCount(this);
            
        }, 500);
    });
});



document.querySelectorAll('.add-to-favorites').forEach(button => {
    button.addEventListener('click', function () {
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


});

document.querySelectorAll('.delete-carted-product').forEach(button => {
    button.addEventListener('click', function () {
        const product_id = this.getAttribute('data-product-id'); 
    
        fetch(`/handlers/update_carted_product.php?product_id=${product_id}`, {
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




// Инициализация 
updateTotalSum();