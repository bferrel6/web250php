<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ben Ferrell's Blue Fortitude | WEB250</title>
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <script src="scripts/addFooter.js" defer></script>
</head>

<body>
    <header>
        <a href="index.php">
            <h1>Ben Ferrell's Blue Fortitude | WEB250</h1>
        </a>
        <h3>Building a Seabed Utopia</h3>
        <nav>
            <a href="?p=home.php">Home</a>
            <a href="?p=introduction.php">Introduction</a>
            <a href="?p=contract.php">Contract</a>
            <a href="?p=brand.php">Brand</a>
        </nav>
    </header>
    <main>

        <!-- insert page content -->
        <?php
        $content = $_GET["p"] ?? null;

        if ($content == "") { $content = "home.php"; }
        include("content/$content");
        ?>

    </main>
    
</body>

</html>