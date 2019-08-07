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

    curl_setopt($ch, CURLOPT_URL, $path);
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
    <form method="post">
        <label for="productCode">Code: </label>
        <input type="text" name="productCode">
        <br>
        <label for="productName">Name: </label>
        <input type="text" name="productName">
        <br>
        <label for="productLine">Line: </label>
        <input type="text" name="productLine">
        <br>
        <label for="productScale">Scale: </label>
        <input type="text" name="productScale">
        <br>
        <label for="productVendor">Vendor: </label>
        <input type="text" name="productVendor">
        <br>
        <label for="productDescription">Description: </label>
        <input type="text" name="productDescription">
        <br>
        <label for="quantityInStock">Quantity: </label>
        <input type="text" name="quantityInStock">
        <br>
        <label for="buyPrice">Buy Price: </label>
        <input type="text" name="buyPrice">
        <br>
        <label for="MSRP">MSRP: </label>
        <input type="text" name="MSRP">
        <br>
        <input type="submit" value="Store Product">
    </form>
    <p><a href="read.php">Products</a></p>
</body>

</html>