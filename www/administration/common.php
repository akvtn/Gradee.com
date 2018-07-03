<?php
class TableHandler
{
    private $filepath;
    public $table;

    function __construct($filepath){
        /* Конструктор класса
        * filepath - путь к файлу который открыт
        * table - данные файла ввиде массива
        */
        $this->filepath = $filepath;
        $this->table = $this->data();
    }

    public function get($searchField,$value){
        /* Возвращает элемент масссивы из соответстующим id
        * searchField - поле для сравнения
        * value - значение поля
        */
        foreach ($this->table as $item) {
            if($item[$searchField] == $value) return $item;
        }
    }

    public function status($id,$field){
        /* Возвращает значение элемента с id поля types
        * id - id искомого элемента
        */
        if($id and $field){
            $item = $this->get("id",$id);
            if($item) return $item[$field];
        }
    }

    public function change($id,$field,$value){
        /* Заменяет значения поля type у элемента с id на value
        * id - id искомого элемента
        * value - новое значение поля
        */
        foreach ($this->table as $key => $item) {
            if($item["id"] == $id) $this->table[$key][$field] = $value;
        }
        $this->rewrite();
    }

    public function sortedRange($start=0,$range=-1,$field="id",$order="-"){
        /* Возвращает отсортированую часть массива
        * start - индекс начального элемента
        * range - индекс последнего элемента
        * field - поле сортировки
        * order - порядок('-' -- убывание,'+' -- возрастание)
        */
        if($range !== -1){
            $buffer = array();
            for ($i=$start; $i < $range ; $i++) {$buffer[] = $this->table[$i];}
        }else {
            $buffer = $this->table;
        }
        $result = array();
        while (!empty($buffer)) {
            $current = $buffer[0];
            for ($i=0; $i < count($buffer); $i++) {
                switch ($order) {
                    case '+': //ascending order
                        if($buffer[$i][$field] < $current[$field])
                            $current = $buffer[$i];
                        break;
                    case '-': //decreasing order
                        if($buffer[$i][$field] > $current[$field])
                            $current = $buffer[$i];
                        break;
                }
            }
            $result[] = $current;
            array_splice($buffer,array_search($current, $buffer),1);
        }
        return $result;
    }

    public function add($data){
        /* Добавляет элемент в начало массива
        * id - id искомого элемента
        */
        $keys = $this->keys;
        array_splice($keys,0,1);
        $buffer = array("id" => $this->table[0]["id"] + 1);
        foreach ($data as $id => $value) {
            $buffer[$keys[$id]] = $value;
        }
        array_unshift($this->table,$buffer);
        $this->rewrite();
    }

    public function delete($id){
        /* Удаляет элемент из соответстующим id
        * id - id искомого элемента
        */
        foreach ($this->table as $index => $item) {
            if($item["id"] == $id) array_splice($this->table,$index,1);
        }
        $this->rewrite();
    }

    private function data(){
        /* Открывает файл и преобразовувает данные в массив */
        $file = fopen($this->filepath,"r");
        $result = array();
        if(flock($file,LOCK_SH)){
            $this->keys = explode(" | ", trim(fgets($file)));
            while ($current = fgets($file)) {
                $current = trim($current);
                $data = explode(" | ", $current);
                $buffer = array();
                foreach ($this->keys as $id => $key) {
                    $buffer[$key] = $data[$id];

                }
                $result[] = $buffer;
            }
        }
        fclose($file);
        return $result;
    }

    private function rewrite(){
        /* Перезаписывает массив в файл
        * data - массив для записи
        */
        $file = fopen($this->filepath,"w");
        if(flock($file,LOCK_EX)){
            fwrite($file,implode(" | ",$this->keys)."\n");
            for ($i=0; $i < count($this->table); $i++) {
                fwrite($file,implode(" | ",$this->table[$i])."\n");
            }
        }
        fclose($file);
    }
}

function uploadFile($filepath){
    $file = fopen($filepath,"r");
    $result = fread($file,filesize($filepath));
    fclose($file);
    return $result;
}

function fillFile($filepath,$data){
    $file = fopen($filepath,"w");
    fwrite($file,$data);
    fclose($file);
}

?>
