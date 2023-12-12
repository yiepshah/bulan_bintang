<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (!function_exists('connectDatabase')) {
    function connectDatabase() {
        $mysqli = new mysqli("localhost", "root", "", "bulan_bintang");

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}
?>   
</body>
</html>