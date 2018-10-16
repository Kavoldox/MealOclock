<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=( $title ?? 'MealOclock' )?></title>
    <link rel="stylesheet" href="<?=$basePath?>/public/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/brands.css">
    <link rel="stylesheet" href="<?=$basePath?>/public/css/style.css">
    <?=$this->section('head')?>
  </head>
  <body data-path="<?=$basePath?>">

    <header>
        <?=$this->insert( 'partials/nav' )?>
    </header>
    <main>
        <?=$this->section('content')?>
    </main>
    <footer>
        Copyright &copy; Oclock <?=date('Y')?>
    </footer>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnH6B49jC0kShCZLi2-gIIrETsRquRVkw"></script>
    <script src="<?=$basePath?>/node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="<?=$basePath?>/public/js/app.js" charset="utf-8"></script>

  </body>
</html>
