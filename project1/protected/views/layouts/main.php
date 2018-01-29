<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="/styles/main.css">
    <script src="/scripts/vendor/modernizr.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<header class="header">
    <div class="container content">
        <h1 class="title">
            HEADER (1000px X 100px)
        </h1>
    </div>
</header>

<main class="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer class="footer">
    <div class="container content">
        <h3 class="title">FOOTER (1000px X 50px)</h3>
    </div>
</footer>

<script src="/scripts/vendor.js"></script>
<script src="/scripts/main.js"></script>

</body>
</html>
