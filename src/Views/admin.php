<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?=($title??'MealOclock')?></title>
        <link rel="stylesheet" href="<?=$basePath?>/public/css/reset.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/brands.css">
        <link rel="stylesheet" href="<?=$basePath?>/public/css/style.css">
    </head>
    <body>
        <header>
            <?php $this->insert('partials/nav_admin') ?>
        </header>
        <main>
            <?=$this->section('content')?>
        </main>
    </body>
</html>
