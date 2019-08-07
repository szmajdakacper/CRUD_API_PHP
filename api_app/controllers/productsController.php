<?php
require_once('models/Product.php');

class ProductsController
{
    public function index()
    {
        $products = new Product('products');
        $products = $products->all();
        echo json_encode($products);
    }

    public function show($id)
    {
        $product = new Product('products');
        $product->find($id, 'productCode');
        echo json_encode($product);
    }

    public function store()
    {
        $request = $_POST;
        $product = new Product('products');

        //Validation
        if (!isset($request['productCode'])
            || !isset($request['productName'])
            || !isset($request['productLine'])
            || !isset($request['productScale'])
            || !isset($request['productVendor'])
            || !isset($request['productDescription'])
            || !isset($request['quantityInStock'])
            || !isset($request['buyPrice'])
            || !isset($request['MSRP'])) {
            Response::responseAndDie('Missing InputData', 'check your inputs', 409);
        } elseif ($request['productCode'] == '' || $request['productName'] == '') {
            Response::responseAndDie('InputData', 'Code and Name can\'t be empty', 409);
        }
        
        $product->productCode = $request['productCode'];
        $product->productName = $request['productName'];
        $product->productLine = $request['productLine'];
        $product->productScale = $request['productScale'];
        $product->productVendor = $request['productVendor'];
        $product->productDescription = $request['productDescription'];
        $product->quantityInStock = $request['quantityInStock'];
        $product->buyPrice = $request['buyPrice'];
        $product->MSRP = $request['MSRP'];
        
        $product->save();
    }

    public function update($id)
    {
        $request = $_POST;
        $product = new Product('products');

        //Validation
        if (!isset($request['productCode'])
            || !isset($request['productName'])
            || !isset($request['productLine'])
            || !isset($request['productScale'])
            || !isset($request['productVendor'])
            || !isset($request['productDescription'])
            || !isset($request['quantityInStock'])
            || !isset($request['buyPrice'])
            || !isset($request['MSRP'])) {
            Response::responseAndDie('Missing InputData - Update Method', 'check your inputs', 409);
        } elseif ($request['productCode'] == '' || $request['productName'] == '') {
            Response::responseAndDie('InputData', 'Code and Name can\'t be empty', 409);
        }
        
        $product->productCode = $request['productCode'];
        $product->productName = $request['productName'];
        $product->productLine = $request['productLine'];
        $product->productScale = $request['productScale'];
        $product->productVendor = $request['productVendor'];
        $product->productDescription = $request['productDescription'];
        $product->quantityInStock = $request['quantityInStock'];
        $product->buyPrice = $request['buyPrice'];
        $product->MSRP = $request['MSRP'];
        
        $product->update($id, 'productCode');
    }

    public function destroy($id)
    {
        $product = new Product('products');
        $product->destroy($id, 'productCode');
    }
}