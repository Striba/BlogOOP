<?php
/**
 * Контроллер управления главной страницей сайта Views: index.php
 * 
 * 
 */

class SiteController
{

    /**
     * Метод формирующий главную страницу сайта
     * 
     * @return boolean
     */
    public function actionIndex()
    {
        //Инициализируем переменную заголовка:
        $title = 'Мой блог - список последних записей';
        //Получаем массив с данными имя пользователя - текст заметки:
        $dataNamesNotes = Notes::getNote();
        
        //Устанавливаем лимит выводимых новостей
        $lim = 5;
        //Получаем выборку данных - массив самых комментируемых заметок
        $dataMostCommentedNotes = Notes::getMostCommentedNotesLimit($lim);
        
        require_once(ROOT . '/views/site/index.php');
        return true;
    }
    
    /**
     * Метод добавления заметки
     * 
     * @return boolean
     */
     public function actionPost()
    {
        //Инициализируем переменные имени автора и текста заметки:
        $name = null;
        $note = null;
        
        //Прием данных из формы и занесение их в таблицу:
        //Если существуют данные в массиве пост, то заносим в переменные:
        if ($_POST){
        //Создаем переменную имени вводящего сообщение:    
        $name = $_POST['name'];
        //Создаем переменную с текстом сообщения:
        $note = $_POST['note'];
        }
        
        //Добавляем данные заметки в таблицу БД:
        $insert = Notes::addNote($name, $note);
        
        //Перенаправляем на главную
        header("Location: / ");

        return true;
    }

}
