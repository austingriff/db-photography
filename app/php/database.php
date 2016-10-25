<?php
/*******************************************************************************

	* database.php
	* contains the database class for interacting with the database

    --------------------------------------------------------------
      public functions
    --------------------------------------------------------------
      * getInstance() - returns an instance of the database
      * query(sql, params[]) - execute sql with array of paramaters
      * action(action, table, param[3])
      * insert()
      * update()
      * get()
      * delete()
      * results()
      * count()
      * error()

*******************************************************************************/

class Db {

  // private data for class
  private static $_instance = null;
  private $_pdo,
          $_query,
          $_error = false,
          $_results,
          $_count = 0;

  // constructor to connect to database
  public function __construct(){
    try {
      $this->_pdo = new PDO('mysql:host=localhost;dbname=anthropology_db', 'root', 'Password1');
    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  // use getInstance to ensure only one connection
  public static function getInstance(){
    if(!isset(self::$_instance)){
      self::$_instance = new Db();
    }
    return self::$_instance;
  }

  // used to prepare and execute queries
  public function query($sql, $params = array()){
    $this->_error = false; // clear error for new query
    if($this->_query = $this->_pdo->prepare($sql)){ // if it was prepared properly
      $x = 1;
      // bind the paramaters
      if(count($params)){
        foreach($params as $param){
          $this->_query->bindValue($x, $param);
          $x++;
        }
      }
      // execute the query
      if($this->_query->execute()){
        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
        $this->_count = $this->_query->rowCount();
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }

  // how to use - action(select *, users, array('user_id', '=', $user_id))
  public function action($action, $table, $where = array()){
    if(count($where) === 3){
      $operators = array('=', '>', '<', '>=', '<=');

      $field = $where[0];
      $operator = $where[1];
      $value = $where[2];

      if(in_array($operator, $operators)){
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
        if(!$this->query($sql, array($value))->error()){
          return $this;
        }
      }
    }
    return false;
  }

  // inserts a row into a table with array
  public function insert($table, $fields = array()){
    if(count($fields)){
      $keys = array_keys($fields);
      $values = '';
      $x = 1;
      foreach($fields as $field){
        $values .= '?';
        if($x < count($fields)){
          $values .= ', ';
        }
        $x++;
      }
      $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
      if(!$this->query($sql, $fields)->error()){
        return true;
      }
    }
    return false;
  }

  // updates a row with id into a table where array
  public function update($table, $attr, $val, $fields){
    $set = '';
    $x = 1;
    foreach($fields as $name => $value){
      $set .= "{$name} = ?";
      if($x < count($fields)){
        $set .= ', ';
      }
      $x++;
    }
    $sql = "UPDATE {$table} SET {$set} WHERE $attr = '{$val}'";
    if(!$this->query($sql, $fields)->error()){
      return true;
    }
    return false;
  }

  // gets all the values from a table where
  public function get($table, $where){
    return $this->action('SELECT *', $table, $where);
  }

  // deletes from a table where
  public function delete($table, $where){
    return $this->action('DELETE', $table, $where);
  }

  // returns the results object
  public function results(){
    return $this->_results;
  }

  // returns the number of affected rows
  public function count(){
    return $this->_count;
  }

  // returns true or false for error
  public function error(){
    return $this->_error;
  }
}

?>
