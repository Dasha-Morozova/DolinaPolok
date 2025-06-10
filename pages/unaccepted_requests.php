<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Заявки</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">

    <style>
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(255, 100, 188, 0.15);
        }
        thead {
            background: linear-gradient(90deg, #007bff, #0056b3) !important;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        th, td {
            padding: 14px;
            vertical-align: middle;
            border-bottom: 2px solidrgb(250, 169, 250);
        }
        tbody tr:nth-child(odd) {
            background-color:rgb(248, 21, 248) !important;
        }
        tbody tr:hover {

            transition: 0.3s;
        }

    </style>       
  </head>
  <body>
	<header>
    </header>
    <main class="">
<div class="container contnt1 mt-5 ">



<div class="mt-4">
    <div class="mb-3 ">
        <h2 class="text_drk_lv me-3">Непринятые заявки</h2>

    </div>
    
    <table class="table table-bordered table-striped">
        <thead >
            <tr  >
                <th class="lavand-2">Имя</th>
                <th  class="lavand-2">Описание</th>
                <th class="lavand-2">Дата создания</th>
                <th class="lavand-2"></th>
            </tr>
        </thead>
        <tbody id="requestsTable">
            <tr data-status="">
                <td>Иван Егоров</td>
                <td>Шкафы в большой зал</td>
                <td>2025-03-25 17:06</td>
                <td class=""><button class="btn btn-main-1 w-100">Принять</button></td>

            </tr>
            <tr data-status="">
                <td>Мария Петрова</td>
                <td>Тумбочки в прихожую</td>
                <td>2025-03-28 16:48</td>
                <td><button class="btn btn-main-1 w-100">Принять</button></td>

            </tr>
        </tbody>
    </table>
</div>

</div>
	</main>
    <footer>
    </footer>
   

	<script src="../script/shopping_cart.js"></script>
  </body>
</html>