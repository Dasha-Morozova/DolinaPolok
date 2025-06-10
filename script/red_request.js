document.getElementById('red_request_form').addEventListener('submit', async function(event) {
event.preventDefault(); 

    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
   
    console.log(data)

    try {
        const response = await fetch('http://valley.ru/handlers/red_request.php', { 
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