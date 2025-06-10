const productsPerPage = 20; // Number of products per page
let currentPage = 1;
let totalPages = 1;



document.addEventListener("DOMContentLoaded", function () {
    loadPage();
    initializeEventListeners();
    
    
    //handleFilterSubmit();
    
});


function initializeEventListeners() {
    const searchForm = document.querySelector(".search_form");
    const filterForm = document.querySelector("#filterModal form");
    const filterSubmitButton = document.querySelector("#filterModal .btn-main-1");

    searchForm.addEventListener("submit", handleSearchSubmit);
    filterSubmitButton.addEventListener("click", handleFilterSubmit);
    FilterSearch();
}
// Обработчик отправки  поиска
function FilterSearch(){
    let filters = {};

    fetch("http://valley.ru/handlers/search_processing.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(filters)
    })
    .then(response => response.json())
    .then(result => {
        console.log("results:", result.message);
        renderProducts(result.message);
        totalPages = Math.ceil(result.length / productsPerPage);
        renderPagination(totalPages, currentPage);
    })
    .catch(error => console.error("Error:", error));

}
// Обработчик отправки формы поиска
function handleSearchSubmit(event) {
    event.preventDefault();
    const searchInput = event.target.querySelector("input[type='search']").value;
    
    fetch("/handlers/search_processing.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ query: searchInput })
    })
    .then(response => response.json())
    .then(data => console.log("Search results:", data))
    .catch(error => console.error("Error:", error));
}
    // Обработчик отправки формы фильтрации
function handleFilterSubmit() {
    const filterForm = document.querySelector("#filterModal form");
    const formData = new FormData(filterForm);
    let filters = {};

    formData.forEach((value, key) => {
        if (value.trim() !== "") {
            filters[key] = value;
        }
    });

    fetch("http://valley.ru/handlers/search_processing.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(filters)
    })
    .then(response => response.json())
    .then(result => {
        console.log("results:", result.message);
        renderProducts(result.message);
        totalPages = Math.ceil(result.length / productsPerPage);
        renderPagination(totalPages, currentPage);
    })
    .catch(error => console.error("Error:", error));
}



async function fetchProducts_not(page) {
            try {
                
                const response = await fetch(`http://valley.ru/handlers/products.php?page=${page}`);
                
                
                if (!response.ok) {
                    throw new Error('Ошибка при получении данных с сервера');
                }
        
                
                const data = await response.json();
        
                renderProducts(data)
                //return data;
            } catch (error) {
                console.error('Ошибка:', error);
                return []; 
            }
        }

        // fetching 
        function fetchProducts(page) {
            // 
            return Array.from({ length: productsPerPage }, (_, i) => ({
                id_old: (page - 1) * productsPerPage + i + 1,
                url: '11',
                name: `Шкаф`, // Product ${(page - 1) * productsPerPage + i + 1}
                price: (Math.random() * 100).toFixed(2),
                image_name: '2.jpg'
            }));
        }

        // Render product cards  // src="http://valley.ru/img/${product.image}.jpg"
        function renderProducts(products) {
            const productGrid = document.getElementById('product-grid');
            productGrid.innerHTML = '';
            products.forEach(product => {
                product.image_name = product.image_name ?? 'default.jpg';
                productGrid.innerHTML += `
                    <div class="col">
                        <div class="card h-100">
							<a href="http://valley.ru/pages/card.php?id=${product.product_id}" class="card-img-top">
								<img src="http://valley.ru/image/${product.image_name}" class="card-img-top" alt="${product.product_name}"> 
							</a>	
                            <div class="card-body card-1">
                                <h5 class="card-title">${product.product_name}</h5>
                                <p class="card-text">${product.price} ₽</p>
                                <div class="justify-content-between">
                                    <button class="btn  mb-2 w-100 btn-main-1 add-to-cart" data-product-id="${product.product_id}">В корзину</button><br>
                                    <button class="btn btn-2  w-100 add-to-favorites" data-product-id="${product.product_id}">В избранное</button>
                                </div>
                            </div>
                        </div>
                    </div>`;
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

        }

// N Render нумерация страниц
function renderPagination_not(totalPages) { 
            const pagination = document.getElementById('pagination');
            const prevPage = document.getElementById('prev-page');
            const nextPage = document.getElementById('next-page');

            // Удалить старые номера страниц
            Array.from(pagination.children).forEach(child => {
                if (child !== prevPage.parentElement && child !== nextPage.parentElement) {
                    pagination.removeChild(child);
                }
            });


            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<button class="page-link my-page-link">${i}</button>`;
                li.addEventListener('click', () => {
                    currentPage = i;
                    loadPage();
                });
                pagination.insertBefore(li, nextPage.parentElement);
            }
}

function renderPagination(totalPages, currentPage) { 
    const pagination = document.getElementById('pagination');
    const prevPage = document.getElementById('prev-page');
    const nextPage = document.getElementById('next-page');

    // Удалить старые номера страниц
    Array.from(pagination.children).forEach(child => {
        if (child !== prevPage.parentElement && child !== nextPage.parentElement) {
            pagination.removeChild(child);
        }
    });

    // Функция для создания элемента страницы
    const createPageItem = (pageNumber) => {
        const li = document.createElement('li');
        li.className = `page-item ${pageNumber === currentPage ? 'active' : ''}`;
        li.innerHTML = `<button class="page-link my-page-link">${pageNumber}</button>`;
        li.addEventListener('click', () => {
            let page_num = pageNumber;
            currentPage = page_num;
            loadPage();
        });
        return li;
    };

    // Добавить первую страницу
    if(currentPage != 1) {
    pagination.insertBefore(createPageItem(1), nextPage.parentElement);
    }

    // Добавить первый эллипсис, если нужно
    if (currentPage > 3) {
        const ellipsis1 = document.createElement('li');
        ellipsis1.className = 'page-item disabled';
        ellipsis1.innerHTML = '<button class="page-link">...</button>';
        pagination.insertBefore(ellipsis1, nextPage.parentElement);
    }

    // Добавить текущую страницу и соседние страницы
    if (currentPage > 2) {
        pagination.insertBefore(createPageItem(currentPage - 1), nextPage.parentElement);
    }
    pagination.insertBefore(createPageItem(currentPage), nextPage.parentElement);
    if (currentPage < totalPages - 1) {
        pagination.insertBefore(createPageItem(currentPage + 1), nextPage.parentElement);
    }

    // Добавить второй эллипсис, если нужно
    if (currentPage < totalPages - 2) {
        const ellipsis2 = document.createElement('li');
        ellipsis2.className = 'page-item disabled';
        ellipsis2.innerHTML = '<button class="page-link">...</button>';
        pagination.insertBefore(ellipsis2, nextPage.parentElement);
    }

    // Добавить последнюю страницу
    if (totalPages > 1 && currentPage != totalPages) {
        pagination.insertBefore(createPageItem(totalPages), nextPage.parentElement);
    }



}




        // Load a specific page
        function loadPage() {
            //let products = fetchProducts(currentPage);
            //renderProducts(products);
            //totalPages = 5;

            renderPagination(totalPages,currentPage);
        }

        // Прослушиватели событий для кнопок "Предыдущий" и "следующий"
        document.getElementById('prev-page').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                loadPage();
            }
        });

        document.getElementById('next-page').addEventListener('click', () => {
            if (currentPage < totalPages) { // Assume всего 5 страниц
                currentPage++;
                loadPage();
            }
        });




//loadPage();