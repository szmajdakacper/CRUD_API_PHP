<?php
class Product extends Model
{
    public $productCode;
    public $productName;
    public $productLine;
    public $productScale;
    public $productVendor;
    public $productDescription;
    public $quantityInStock;
    public $buyPrice;
    public $MSRP;
    
    public function __construct($tableName)
    {
        parent::__construct($tableName);
    }

    public function all()
    {
        $stmt = parent::all();
        while ($row = $stmt->fetchObject(__CLASS__, [$this->table])) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find($id, $column = '')
    {
        $stmt = parent::find($id, $column);
        
        if ($stmt->rowCount() <= 0) {
            Response::responseAndDie('FindData', 'Data Not Found', 409);
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($row as $column => $value) {
            $this->$column = $value;
        }
    }

    public function save()
    {
        parent::insert($this);
    }

    public function destroy($id, $column = '')
    {
        parent::delete($id, $column);
    }

    public function update($id, $column = '')
    {
        $stmt = parent::find($id, $column);
        
        if ($stmt->rowCount() <= 0) {
            Response::responseAndDie('FindData', 'Data Not Found', 409);
        }

        parent::updateSet($this, $id, $column);
    }
}