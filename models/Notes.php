<?php

/* 
 * Модель для работы с таблицей заметок notes
 * 
 */

class Notes 
{

    /**
     * Метод добавления заметок в таблицу БД notes
     *  
     * @param string $name - имя пользователя
     * @param string $note - заметка пользователя
     * @return boolean
     */
    public static function addNote ($name,$note) {
        
        //Соедиение с БД:
        $db = Db::getConnection();

        //Вставляем полученные данные в табличку БД notes:
        
        //Формируем SQL подготовленный(защищенный) запрос:
        $sql = "INSERT  INTO `notes` (name, note) "
                . "VALUES (:name, :note)";
       
        $rs = $db->prepare($sql); 
        
        //Связываем переменные:
        $rs->bindParam(':name', $name, PDO::PARAM_STR);
        $rs->bindParam(':note', $note, PDO::PARAM_STR);
        //Исполняем запрос:
        $rs->execute();

        if($rs){
            return TRUE;
        } else {
            echo 'Не удалось добавить заметку';
            return FALSE;
        }
        
    }
    
    /**
     * Метод получения заметок из БД notes
     *
     * @param int $id - айди заметки - необязательный параметр
     * @return array $data - массив с данными 
     */
    public static function getNote ($id = null) {
        
        //Соедиение с БД:
        $db = Db::getConnection();

        //Выбираем данные из БД notes:
        
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
                if(strlen($data[$i]['note']) > 100){
                    $data[$i]['note'] = substr($data[$i]['note'],0,100).'...';
                }
                //Увеличиваем счетчик на 1
                $i++;    
            }
        };

        return $data;
    }
    
    
    /**
     * Метод получения самых комментируемых заметок
     *
     * @param int $lim - лимит колличества выводимых заметок в слайдер
     * @return array $data - массив с данными 
     */
    public static function getMostCommentedNotesLimit ($lim) {
        
        //Соедиение с БД:
        $db = Db::getConnection();

        //Вставляем полученные данные в табличку БД notes:
        
        //Формируем SQL запрос выборки 
        //по колличеству комментариев в обратном порядке с лимитом $lim:
        $sql = "SELECT * FROM `notes` "
                . "ORDER BY count_comments DESC "
                . "LIMIT $lim ";
                
        $rs = $db->query($sql);
        
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
                if(strlen($data[$i]['note']) > 100){
                    $data[$i]['note'] = substr($data[$i]['note'],0,100).'...';
                }
                //Увеличиваем счетчик на 1
                $i++;    
            }
        };

        return $data;
    }
    
}