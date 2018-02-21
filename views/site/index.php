<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title><?php echo $title;?></title>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- Подключение библиотек: -->
<!-- jQuery lib CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
 <!-- Bootstrap4 lib CDN-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Подключение JS скрипта -->
<script type="text/javascript" src="/js/main.js"></script>

<!-- Подключение файла со своими стилями -->
<link rel="stylesheet" href="/templates/css/reset.css"> <!-- CSS reset -->
<link rel="stylesheet" href="/templates/css/style_slider.css"> <!-- Resource style -->
<script src="/templates/js/modernizr.js"></script> <!-- Modernizr -->
<link href="/templates/css/style.css" rel="stylesheet" type="text/css"> 
<style>
   body {
    background: #333; /* Цвет фона */
    color: #fc0; /* Цвет текста */
   }
  </style>

</head>

<body>
  
        <!-- --------------------------------------SLIDER BEGIN----------------------------------- -->

        <div class="wrapper container-fluid">
            <div><h5 class="text-center">Блог - пишите заметки</h5></div><br /><br />
            
    <div class="cd-testimonials-wrapper cd-container">
	<ul class="cd-testimonials">
		<?php foreach($dataMostCommentedNotes as $mostCommentedNote):?>
                <li>
			<p>Текст заметки:<br/> <?php echo $mostCommentedNote['note'];?></p>
			<div class="cd-author">
				<!-- <img src="img/avatar-1.jpg" alt="Author image"> -->
				<ul class="cd-author-info">
					<li>Автор: <?php echo $mostCommentedNote['name'];?></li>
                                        <li>Дата добавления: <?php echo $mostCommentedNote['published_at'];?> </li>
                                        <li>Колличество комментариев: <?php echo $mostCommentedNote['count_comments'];?> </li>
				</ul>
			</div>
		</li>
                <?php endforeach;?>
	</ul> <!-- cd-testimonials -->
</div> <!-- cd-testimonials-wrapper -->


    <!-- -------------------------------------SLIDER END------------------------------------ -->

        <div>
            <div class="text-center"><b>Оставить сообщение:</b></div><br /><br />
            <form action="/post" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-xs-2 control-label">Введите ваше имя:</label><br />
                    <div class="col-xs-8">
                        <input type="text" id="name" name="name" placeholder = "Ваше имя" class="form-control"><br />
                    </div>
                </div>
                <div class="form-group">
                    <label for="note" class="col-xs-2 control-label">Введите текст заметки:</label><br />
                    <div class="col-xs-8">
                        <textarea type="text" id="note" name="note" placeholder="Пишем текст..." class="form-control"></textarea><br />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 colxs-10">
                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </div>
                </div>
            </form>
        </div>
        <div >
        <?php foreach ($dataNamesNotes as $nameNote):?>
            <p> <h5><?php echo $nameNote['name'];?></h5></p>
            <div>Текст заметки:<br />
            <?php echo $nameNote['note'];?>
            </div>
        Колличество коментариев: '<?php echo $nameNote['count_comments'];?>'  Добавленно: '<?php echo $nameNote['published_at'];?>'
        <a class="badge badge-primary" href="note/<?php echo $nameNote['id'];?>">Перейти к коментарию</a>
            <?php endforeach;?>
        </div>

</div>


    
    
    
<!-- cd-testimonials-all -->
<script src="/templates/js/jquery-2.1.1.js"></script>
<script src="/templates/js/masonry.pkgd.min.js"></script>
<script src="/templates/js/jquery.flexslider-min.js"></script>
<script src="/templates/js/main.js"></script> <!-- Resource jQuery -->




</body>
</html>