<?php
/**
 * Class Model - used to communicate with database
 * @param TableName
 */
class Model
{
    protected $table;
    protected $db;
    protected $columns;

    protected function __construct($tableName)
    {
        $this->table = $tableName;
        $this->db = new Database();
    }

    public function describeTable()
    {
        $sql = "describe {$this->table}";
        if ($stmt = $this->db->pdo->prepare($sql)) {
            $stmt->execute();

            while ($column = $stmt->fetch()) {
                $this->columns[] = $column['Field'];
            }
        } else {
            Response::responseAndDie('InsertData', 'Error With Prepared Statement', 500);
        }
    }

    public function all()
    {
        $sql_selectAll = "SELECT * FROM {$this->table}";

        if ($stmt = $this->db->pdo->prepare($sql_selectAll)) {
            $stmt->execute();

            return $stmt;
        } else {
            Response::responseAndDie('InsertData', 'Error With Prepared Statement', 500);
        }
    }

    public function find($id, $column = '')
    {
        //if column is not defined, function will be searching by 'id'
        if ($column != '') {
            $sql_selectOne = "SELECT * FROM {$this->table} WHERE $column = :id";
        } else {
            $sql_selectOne = "SELECT * FROM {$this->table} WHERE id = :id";
        }

        if ($stmt = $this->db->pdo->prepare($sql_selectOne)) {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return $stmt;
        } else {
            Response::responseAndDie('InsertData', 'Error With Prepared Statement', 500);
        }
    }

    public function insert($child)
    {
        $this->describeTable();
        $sql_insert = "INSERT INTO {$this->table} ("
        .implode(', ', ($this->columns)).
        ") VALUES (:"
        .implode(', :', ($this->columns)).
        ")";
        
        if ($stmt = $this->db->pdo->prepare($sql_insert)) {
            foreach ($this->columns as $column) {
                $stmt->bindParam(":$column", $child->$column);
            }
            
            if ($stmt->execute()) {
                Response::responseAndDie('InsertData', 'Data Added Correct', 201);
            } else {
                Response::responseAndDie('InsertData', 'Statement Not Executed', 409);
            }
        } else {
            Response::responseAndDie('InsertData', 'Error With Prepared Statement', 500);
        }
    }

    public function delete($id, $column = '')
    {

        //if column is not defined, function will be deleting by 'id'
        if ($column != '') {
            $sql_delete = "DELETE FROM {$this->table} WHERE $column = :id";
        } else {
            $sql_delete = "DELETE FROM {$this->table} WHERE id = :id";
        }

        if ($stmt = $this->db->pdo->prepare($sql_delete)) {
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() <= 0) {
                    Response::responseAndDie('FindData', 'Data Not Found', 409);
                } else {
                    Response::responseAndDie('DeleteData', 'Data Deleted Correct', 200);
                }
            } else {
                Response::responseAndDie('DeleteData', 'Statement Not Executed', 409);
            }
        } else {
            Response::responseAndDie('InsertData', 'Error With Prepared Statement', 500);
        }
    }

    public function updateSet($child, $id, $byColumn = '')
    {
        $this->describeTable();

        //if column is not defined, function will be changing by 'id'
        if ($byColumn != '') {
            $sql_update = "UPDATE {$this->table} SET ";
            foreach ($this->columns as $column) {
                $sql_update .= "$column = :$column, ";
            }
            $sql_update = substr($sql_update, 0, -2);
            $sql_update .= " WHERE $byColumn = :id";
        } else {
            $sql_update = "UPDATE {$this->table} SET ";
            foreach ($this->columns as $column) {
                $sql_update .= "$column = :$column, ";
            }
            $sql_update = substr($sql_update, 0, -2);
            $sql_update .= " WHERE id = :id";
        }

        if ($stmt = $this->db->pdo->prepare($sql_update)) {
            foreach ($this->columns as $column) {
                $stmt->bindParam(":$column", $child->$column);
            }
            $stmt->bindParam(':id', $id);
                        
            if ($stmt->execute()) {
                Response::responseAndDie('UpdateData', 'Data Updated Correct', 201);
            } else {
                Response::responseAndDie('UpdateData', 'Statement Not Executed', 409);
            }
        } else {
            Response::responseAndDie('UpdateData', 'Error With Prepared Statement', 500);
        }
    }
}