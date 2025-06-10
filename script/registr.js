// Маска ввода для телефона
const phoneInput = document.getElementById('phone');

phoneInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); 
            let formattedValue = '+';
            if (value.length > 0) {                
                formattedValue +=  value.substring(0, 1);
            }
            if (value.length > 1) {
                formattedValue += '(' + value.substring(1, 4);
            }
            if (value.length > 4) {
                formattedValue += ')' + value.substring(4, 7);
            }
            if (value.length > 7) {
                formattedValue += '-' + value.substring(7, 9);
            }
            if (value.length > 9) {
                formattedValue += '-' + value.substring(9, 11);
            }
            e.target.value = formattedValue.trim(); 
 });

document.getElementById('registrationForm').addEventListener('submit', async function(event) {
    event.preventDefault(); 
        // Валидация телефона
            const phone = phoneInput.value;
            const phonePattern = /^\+7\(\d{3}\)\d{3}\-\d{2}\-\d{2}$/;

            if (!phonePattern.test(phone)) {
                alert('Введите номер телефона в формате +7(XXX)XXX-XX-XX.');
                return; 
            }
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    data.phone = data.phone.replace(/\D/g, '');
    console.log(data);


    //console.log(data);
    //alert(data.name);

    try {
        const response = await fetch('http://valley.ru/handlers/user.php', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
            const result = await response.json();

        if (response.ok) {
            window.location.href = result.message ;
            
        } else {
            
            console.log('Ошибка: ' + result.message);
        }
        
    } catch (error) {
        console.log('Ошибка сети:', error);
        
    }
});