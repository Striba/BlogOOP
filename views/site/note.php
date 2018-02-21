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

<!-- Подключение файла со своими стилями -->
<link href="/templates/css/style.css" rel="stylesheet" type="text/css"> 
<!-- Подключение JS скрипта -->
<script type="text/javascript" src="/templates/js/main.js"></script>

</head>

<body>
        <div class="wrapper container-fluid">
            
            <div><h3 class="text-center">Блог - пишите комментарии</h3></div>
            <a href="/" class="badge badge-pill badge-warning">Вернутья к списку заметок</a>
            <div >
                <p> <h5><?php echo $nameNote[0]['name'];?></h5></p>
                <div>Текст заметки:<br />
                <?php echo $nameNote[0]['note'];?>
                </div>
            Колличество коментариев: '<?php echo $nameNote[0]['count_comments'];?>'  Добавленно: '<?php echo $nameNote[0]['published_at'];?>'
                
            </div>
            <!-- Айди комментария: <?php //echo $nameNote[0]['id'];?> -->
            <div>
                <div><b>Оставить коментарий:</b></div>
                <form action="/note/post/<?php echo $nameNote[0]['id'];?>" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-xs-2 control-label" >Введите ваше имя:</label><br />
                        <div class="col-xs-8">
                            
                            <input type="text" id="name" name="name" placeholder = "Ваше имя" class="form-control" required ><br />
                        </div>
                        <input type="hidden" name="count_comments" value="<?php echo $nameNote[0]['count_comments'];?>">
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-xs-2 control-label">Введите текст комментария:</label><br />
                        <div class="col-xs-8">
                            <textarea type="text" id="text" name="text" placeholder="Пишем текст..." class="form-control" required="required" ></textarea><br />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-2 colxs-10">
                            <input type="submit" class="btn btn-primary" value="Сохранить">
                        </div>
                    </div>
                </form>
                <div >
                <?php foreach ($dataNamesComments as $nameComment):?>
                <p> <h5><?php echo $nameComment['name'];?></h5></p>
                <div>Текст заметки:<br />
                <?php echo $nameComment['text'];?>
                </div>
                Добавленно: '<?php echo $nameComment['published_at'];?>'
                <?php endforeach;?>
        </div>
            </div>
        </div>



</body>
</html>

