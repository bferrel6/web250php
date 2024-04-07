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
        <h1>Ben Ferrell's Blue Fortitude | WEB250</h1>
        <h3><em>Building a Seabed Utopia</em></h3>
        <nav>
            <a href="?p=">Home</a>
            <a href="?p=introduction">Introduction</a>
            <a href="?p=contract">Contract</a>
            <a href="?p=brand">Brand</a>
            <a href="?p=viewModules">Fleet Modules</a>
            <a href="?p=forms">Forms</a>
        </nav>
    </header>
    <main>

        <!-- insert page content -->
        <?php
        $content = $_GET["p"] ?? null;

        if ($content == "") { $content = "home"; }
        include("content/$content.php");
        ?>

    </main>
</body>

</html>