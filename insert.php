<?php
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Connectie gemaakt!";
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $product_naam = $_POST["product_naam"];
    $prijs_per_stuk = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];

   
    $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_naam, $prijs_per_stuk, $omschrijving]);

    if ($stmt->rowCount() > 0) {
        echo "Product succesvol toegevoegd.";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van het product.";
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" action="insert.php">

<label for="product_naam">productnaam</label>
<input type="text" name = "product_naam" id = "productnaam" required><br>



<label for="prijs_per_stuk">prijs per stuk</label>
<input type="numer" step="0.01" name = "prijs_per_stuk" id = "prijs_per_stuk" required><br>




<label for="omschhrijving">omschrijving</label>
<textarea name = "omschrijving" id = "omschrijving" required></textarea><br>


<input type="submit" value = "verzenden">


</form>
    
</body>
</html>