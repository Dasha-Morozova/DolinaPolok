<?php 

    $page = $_GET['page'] ?? null;
    $search = $_GET['search'] ?? null;

    if ($search) {
        echo "GET  ";


    } else {
        echo " ";    

    if ($page) {
        $page = (int)$page;
    
        // Проверяем, что номер страницы является положительным числом
        if ($page > 0) {
            // Выполняем действия для загрузки данных для указанной страницы
            //   $page для пагинации в запросе к базе данных

            echo "Загружаем данные для страницы: " . $page;
        } else {
             
        }
    } else {
        
    }

}

?>