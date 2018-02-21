<?php
/**
 * Контроллер заметок NotesController
 * 
 * 
 */

class NotesController
{
    /**
     * Метод полученя представления страницы комментирования выбранной заметки
     * 
     * @param int $id - айди выбранной заметки
     * @return boolean
     */
    public function actionGetFullNotePage($id) {
        
        //Получаем массив с данными выбранной заметки по айди $id
        $nameNote = Comments::getNote($id);
        
        //Инициализация переменной данных коментария
        $dataNamesComments = null;
        
        //Запрос данных комментария в массив если таковые имеются:
        $dataNamesComments = Comments::getComment($id);
        
        //Инициализируем переменную названия страницы:
        $title = 'Заметка пользователя : ' . $nameNote[0]['name'];
        
        $countComments = $nameNote[0]['count_comments'];
        
        require_once(ROOT . '/views/site/note.php');
        return true;
        
    }
    
    /**
     * Метод добавления коментария к заметке с идентификатором $notes_id
     * 
     * @param int $notes_id айди замекти к которой комментарий вносится
     * @return boolean
     */
    public function actionPost($notes_id) {
        
        //Инициализируем переменные имени автора и текста комментария, 
        //айди заметки и числом комментариев:
        $name = null;
        $text = null;
        $countComments = null;
        
        //Прием данных из формы и занесение их в таблицу:
        //Если существуют данные в массиве пост, то заносим в переменные:
        if ($_POST){
        //Создаем переменную имени вводящего сообщение:    
        $name = $_POST['name'];
        //Создаем переменную с текстом сообщения:
        $text = $_POST['text'];
        //Создаем переменную с числом комментариев:
        $countComments = $_POST['count_comments'];
        }
        
        //Добавляем данные комментария в таблицу БД:
        $insert = Comments::addComment($name, $text, $notes_id, $countComments);
        
        if($insert){
        
        //Перенаправляем на предидущую страницу с полным комментарием:
        header("Location: /note/".$notes_id);

        return true;
        } else {
            echo 'Не получилось добавить комментарий!!';
            return FALSE;
        }
    }

}

