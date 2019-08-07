<?php
$fp = fopen('path.txt', 'r');
$path = fgets($fp, 999);
fclose($fp);
if (count($_POST) > 0) {
    $ch = curl_init();

    $data = array();
    foreach ($_POST as $name => $value) {
        $data[$name] = $value;
    }
    $data['_method'] = 'PUT';

    curl_setopt($ch, CURLOPT_URL, $path.'/'.$_GET['code']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_exec($ch);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <?php
    $ch = curl_init($path.'/'.$_GET['code']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    // Access the exchange rate values. For example $exchangeRates[rates][PLN]:
    $product = json_decode($json, true);

    ?>
    <form method="post">
        <label for="productCode">Code (readonly): </label>
        <input type="text" value="<?php echo $product['productCode'] ?>" name="productCode" readonly>
        <br>
        <label for="productName">Name: </label>
        <input type="text" value="<?php echo $product['productName'] ?>" name="productName">
        <br>
        <label for="productLine">Line: </label>
        <input type="text" value="<?php echo $product['productLine'] ?>" name="productLine">
        <br>
        <label for="productScale">Scale: </label>
        <input type="text" value="<?php echo $product['productScale'] ?>" name="productScale">
        <br>
        <label for="productVendor">Vendor: </label>
        <input type="text" value="<?php echo $product['productVendor'] ?>" name="productVendor">
        <br>
        <label for="productDescription">Description: </label>
        <input type="text" value="<?php echo $product['productDescription'] ?>" name="productDescription">
        <br>
        <label for="quantityInStock">Quantity: </label>
        <input type="text" value="<?php echo $product['quantityInStock'] ?>" name="quantityInStock">
        <br>
        <label for="buyPrice">Buy Price: </label>
        <input type="text" value="<?php echo $product['buyPrice'] ?>" name="buyPrice">
        <br>
        <label for="MSRP">MSRP: </label>
        <input type="text" value="<?php echo $product['MSRP'] ?>" name="MSRP">
        <br>
        <input type="hidden" name="_method" value="PUT">
        <input type="submit" value="Store Product">
    </form>
    <p><a href="read.php">Products</a></p>
</body>

</html>