// Маска 
const phoneInput = document.getElementById('phone');



document.getElementById('updateUserForm').addEventListener('submit', async function(event) {
    event.preventDefault(); 
        // Валидация телефона
            const phone = phoneInput.value;
            const phonePattern = /^\d{11}$/;

            if (!phonePattern.test(phone)) {
                //alert('Введите номер телефона в формате +7(XXX)XXX-XX-XX.');
                //return; 
            }
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    data.phone = data.phone.replace(/\D/g, '');
    console.log(data)




    try {
        const response = await fetch('http://valley.ru/handlers/user.php', { 
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
            const result = await response.json();

        if (response.ok) {
            window.location.href = result.message ;
            
        } else {
            alert('Ошибка: ' + result.message);
        }
        
    } catch (error) {
        console.log('Ошибка сети:', error);
        
    }
});