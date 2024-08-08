<?php
require "Database.php";

class QueryBuilder{
    protected $data;
    public function __construct($pdo) {
        $this->data = $pdo;
    }
    public function select($query){
        $statement = $this->data->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function count($query){
        $statement = $this->data->prepare($query);
        $statement->execute();
        return $statement->rowCount();
    }
    public function insert($array){
        $statement = $this->data->prepare("INSERT INTO user (name,email, address,password,profile) VALUES (?,?,?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertComment($array){
        $statement = $this->data->prepare("INSERT INTO comment (body,profile,user_id,show_id,username) VALUES (?,?,?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertShows($array){
        $statement = $this->data->prepare("INSERT INTO shows (title,category_id,author,cover,intro,body) VALUES (?,?,?,?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertFavorite($array){
        $statement = $this->data->prepare("INSERT INTO followings (title,category_id,intro,author,body,img,user_id,show_id) VALUES (?,?,?,?,?,?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function deleteQuery($delete){
        $statement = $this->data->prepare($delete);
        $statement->execute();
    }
    public function updateShows($array,$show_id){
        $statement = $this->data->prepare("UPDATE shows SET title=?,category_id=?,author=?,cover=?,intro=?,body=? WHERE id=$show_id");
        $value = array_values($array);
        $statement->execute($value);
    }
    public function insertAdmin($array){
        $statement = $this->data->prepare("INSERT INTO admins (name,email,password) VALUES (?,?,?)");
        $value = array_values($array);
        $statement->execute($value);
    }
}

$db = new QueryBuilder(Database::query());

