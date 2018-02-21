<?php

/* 
 * Модель для работы с таблицей заметок comments
 * 
 */

class Comments 
{
    /**
     * Метод добавления заметок в таблицу БД comments
     *  
     * @param string $name - имя комментатора
     * @param string $text - текст комментария к заметке пользователя
     * @param int $notes_id Соответсвующих идентификатор замекти
     * @param int $countComments счетчик комментариев
     * @return boolean
     */
    public static function addComment ($name,$text, $notes_id, $countComments) {
        
        //Соедиение с БД:
        $db = Db::getConnection();
        
        //Инкрементируем поступившее колличество заметок:
        $countComments++;
        
        //Формируем SQL запрос обновление значения колличества комментариев:
        $sql = "UPDATE `notes` "
                . "SET count_comments = '{$countComments}' "
                . "WHERE id = '{$notes_id}'";
        
        //Выполняем вставку обновленного колличества комментариев:
        $result = $db->query($sql);
        
        if ($result){
            //Вставляем полученные данные в табличку БД notes:

            //Формируем SQL подготовленный(защищенный) запрос:
            $sql = "INSERT  INTO `comments` (name, text, notes_id) "
                    . "VALUES (:name, :text, :notes_id)";

            $rs = $db->prepare($sql); 

            //Связываем переменные:
            $rs->bindParam(':name', $name, PDO::PARAM_STR);
            $rs->bindParam(':text', $text, PDO::PARAM_STR);
            $rs->bindParam(':notes_id', $notes_id, PDO::PARAM_INT);
            //Исполняем запрос:
            $rs->execute();

            if($rs){
                return TRUE;
            } else {
                echo 'Не получилось добавить комментарий!!';
                return FALSE;
            }
        } else {
            echo 'Не получилось добавить комментарий!!';
                return FALSE;
        }
        
    }
    
    /**
     * Метод получения заметок из БД таблицы notes
     *
     * @param int $id - айди заметки - необязательный параметр
     * @return array $data - массив с данными 
     */
    public static function getNote ($id = null) {
        
        //Соедиение с БД:
        $db = Db::getConnection();

        //Выбераем данные из БД notes:
        
        //Формируем SQL подготовленный(защищенный) запрос:
        $sql = "SELECT * FROM `notes` ";
        
        if(isset($id)){
            //Расширяем запрос условием выбора по айди:
            $sql .= 'WHERE id = :id';
        }
       
        $rs = $db->prepare($sql);
        if(isset($id)){
            //Привязывем переменную:
            $rs->bindParam(':id', $id, PDO::PARAM_INT);
        }
        //Исполняем запрос:
        $rs->execute();
        
        //Инициализируем массив сбора данных из БД:
        $data = array();
        
        //Инициализируем счетчик для номера массива: 
        $i = 0;
        //Заполняем массив $data данными из БД:
        while($row = $rs->fetch(PDO::FETCH_ASSOC)){
            
            //Исключаем пустые значения:
            if($row['name'] != null && $row['note'] != null){
                $data[$i]['id'] = $row['id'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['count_comments'] = $row['count_comments'];
                $data[$i]['published_at'] = $row['published_at'];
                
                $data[$i]['note'] = $row['note'];
                //Проверяем колличество символов в поступившем тексте, 
                //и обрезаем до 100, при необходимости
                if(strlen($data[$i]['note']) > 100 && !isset($id)){
                    $data[$i]['note'] = substr($data[$i]['note'],0,100).'...';
                } 
                //Увеличиваем счетчик на 1
                $i++;    
            }
        };
 
        return $data;
    }
    
    
    /**
     * Метод получения комментариев из БД для заметки с айди $notes_id
     * 
     * @param int $notes_id - айди заметки для которой комментарии выбираются
     * @return array $data - массив с данными
     */
    public static function getComment($notes_id){
    
        //Соедиение с БД:
        $db = Db::getConnection();

        //Вставляем полученные данные в табличку БД comments:
        
        //Формируем SQL подготовленный(защищенный) запрос:
        $sql = "SELECT * FROM `comments` "
                . "WHERE notes_id = :notes_id";
      
       
        $rs = $db->prepare($sql);
        //Привязывем переменную:
        $rs->bindParam(':notes_id', $notes_id, PDO::PARAM_INT);
        //Исполняем запрос:
        $rs->execute();
        
        //Инициализируем массив сбора данных из БД:
        $data = array();
        
        //Инициализируем счетчик для номера массива: 
        $i = 0;
        //Заполняем массив $data данными из БД:
        while($row = $rs->fetch(PDO::FETCH_ASSOC)){
            
            //Исключаем пустые значения:
            if($row['name'] != null && $row['text'] != null){
                $data[$i]['id'] = $row['id'];
                $data[$i]['name'] = $row['name'];
                $data[$i]['notes_id'] = $row['notes_id'];
                $data[$i]['published_at'] = $row['published_at'];
                $data[$i]['text'] = $row['text'];

                //Увеличиваем счетчик на 1
                $i++;    
            }
        };
        
        return $data;
    }
    
}