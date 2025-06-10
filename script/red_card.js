// Получаем все элементы с классом 'productImages'
var elements = document.querySelectorAll('.productImages');
/*
// Перебираем все найденные элементы
elements.forEach(function(element) {
    // Добавляем обработчик событий к каждому элементу
    element.addEventListener('input', function(event) {
        // Ваш код для обработки события
		const file = event.target.files[0];
		const maxFileSizeMB = 2;

		// Очищаем ошибки
		let errors = [];

			// Проверка типа файла
			if (!file.type.startsWith('image/')) {
				errors.push(`Файл "${file.name}" не является изображением.`);
			}

			// Проверка размера файла. Размер каждого файла не превышал 2 МБ.
			if (file.size > maxFileSizeMB * 1024 * 1024) {
				errors.push(`Файл "${file.name}" превышает размер ${maxFileSizeMB} МБ.`);
			}
		

		if (errors.length > 0) {
			alert(errors.join('\n'));
			event.target.value = ''; // Сбрасываем выбор файлов
		}
	       
    });
});
*/

document.getElementById('productForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    console.log(data);

    const textData = {
        product_name: document.getElementById('productName').value,
        sku: document.getElementById('productCode').value,
        price: document.getElementById('productPrice').value,
        description: document.getElementById('productDescription').value,
        material: document.getElementById('material').value,
        warranty: document.getElementById('warranty').value,
        color: document.getElementById('color').value,
        height: document.getElementById('height').value,
        width: document.getElementById('width').value,
        length: document.getElementById('length').value,
        furniture_type: document.getElementById('furniture_type').value,
        furniture_subtype: document.getElementById('furniture_subtype').value,
        shelf_count: document.getElementById('shelfCount').value,
        drawer_count: document.getElementById('drawerCount').value,
        storage_count: document.getElementById('storage_count').value
    };
    formData.append('textData', JSON.stringify(textData));
    
    try {
        // Отправка данных на сервер
        const response = await fetch('http://valley.ru/handlers/products.php', { 
            method: 'POST',
            body: formData, 
        }); 
            const result = await response.json();   
            // response.text();

        if (response.ok) {
            window.location.href = result.message ; 
              
        } else {          
        	console.log('Ошибка: ' + result.message);
        }
        
    } catch (error) {
        console.log('Ошибка сети:', error);
        
    }
}); 
