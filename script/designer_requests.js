   $(document).ready(function() {
        $("#filterForm").submit(function(event) {
            event.preventDefault(); 

            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            var status = $("#status").val();

            const formData = new FormData();
            formData.append('startDate', startDate);
            formData.append('endDate', endDate);
            formData.append('status', status);


            fetch('/get_applications', { 
                method: 'POST', //  'GET'
                body: formData 
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); //  response.json()
            })
            .then(data => {
               
                $("#results").html(data); // Отображаем 

    
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                $("#results").html("<p>Произошла ошибка при загрузке заявок.</p>");
            });

            console.log("Начальная дата:", startDate);
            console.log("Конечная дата:", endDate);
            console.log("Статус:", status);
            $("#results").html("<p>Отправлен запрос на получение заявок за период с " + startDate + " по " + endDate + " и статусом: " + status + "</p>");
        });
    });