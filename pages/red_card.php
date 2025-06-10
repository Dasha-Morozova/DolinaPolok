<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Redcting card</title>

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
	<link rel="stylesheet" type="text/css" href="../styles/color.css">   
  </head>
  <body>
	<header>
    </header>
<main>
    <div class="container contnt1 mt-5">
		<div class="row justify-content-center">
		<h2 class="col-md-10 " >Редактирование товара</h2>
		</div>
		<div class="row justify-content-center">

        <form class="col-md-10 justify-content-center" id="productForm" enctype="multipart/form-data">
        <div class="card">
        <div class="card-body bg-blue">			
            <!-- Основные поля -->
			<div class="row ">
            <div class="mb-3">
                <label for="productName" class="form-label">Название</label>
                <input type="text" class="form-control" id="productName" name="product_name" placeholder="Введите название">
            </div>
            <div class="col-md-6 mb-3">
                <label for="productCode" class="form-label">Артикул</label>
                <input type="text" class="form-control" id="productCode" name="sku" placeholder="Введите артикул">
            </div>
            <div class="col-md-6 mb-3">
                <label for="productPrice" class="form-label">Цена</label>
                <input type="number" class="form-control" id="productPrice" name="price" placeholder="Введите цену">
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Описание</label>
                <textarea class="form-control" id="productDescription" rows="3" name="description" placeholder="Введите описание"></textarea>
            </div>			

            <!-- Фотографии -->
            <div class="mb-2">
                <label class="form-label">Фотографии</label>
				<div class="form-text mb-1">Можно загрузить до 5 фотографий.</div>
                <input type="file" class="form-control mb-2 productImages"   accept=".png, .jpg, .jpeg" name="image_1">
                <input type="file" class="form-control mb-2 productImages"   accept=".png, .jpg, .jpeg" name="image_2">
				<input type="file" class="form-control mb-2 productImages"   accept=".png, .jpg, .jpeg" name="image_3">
				<input type="file" class="form-control mb-2 productImages"   accept=".png, .jpg, .jpeg" name="image_4">
				<input type="file" class="form-control mb-2 productImages"   accept=".png, .jpg, .jpeg" name="image_5">

<!-- Фотографии                <input type="file" name="photos[]" multiple accept="image/*">-->
            </div>
			</div>

            <!-- Характеристики -->
            <h3 class="mt-4">Характеристики</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="material" class="form-label">Материал</label>
                    <input type="text" class="form-control" id="material" name="material" placeholder="Введите материал">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="warranty" class="form-label">Гарантия</label>
                    <input type="text" class="form-control" id="warranty" name="warranty" placeholder="Введите срок гарантии">
                </div>                
                <div class="col-md-12 mb-3">
                    <label for="color" class="form-label">Основной цвет</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Введите цвет">
                </div>

            </div>

         
            <h3 class="mt-4">Габариты</h3>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="height" class="form-label">Высота (см)</label>
                    <input type="number" class="form-control" id="height" name="height">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="width" class="form-label">Ширина (см)</label>
                    <input type="number" class="form-control" id="width" name="width">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="length" class="form-label">Длина(см)</label>
                    <input type="number" class="form-control" id="length" name="length">
                </div>
            </div>


            <h3 class="mt-4">Дополнительные характеристики</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="furniture_type" class="form-label">Тип мебели</label>
                    <input type="text" class="form-control" id="furniture_type" name="furniture_type" placeholder="Введите тип мебели">

                </div>			
                <div class="col-md-6 mb-3">
                    <label for="furniture_subtype" class="form-label">Подтип мебели</label>
                    <input type="text" class="form-control" id="furniture_subtype" name="furniture_subtype" placeholder="Введите подтип мебели">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="shelfCount" class="form-label">Количество полок</label>
                    <input type="number" class="form-control" id="shelfCount" name="shelf_count">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="drawerCount" class="form-label">Количество ящиков</label>
                    <input type="number" class="form-control" id="drawerCount" name="drawer_count">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="storage_count" class="form-label">Количество на складе</label>
                    <input type="number" class="form-control" id="storage_count" name="storage_count">
                </div>                
            </div>

           
            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-main-1">Сохранить</button>
            </div>
		</div>
		</div>				
        </form>
    </div>
	</div>

</main>
    <footer>
    </footer>

	<script src="../script/red_card.js"></script>
  </body>
</html>