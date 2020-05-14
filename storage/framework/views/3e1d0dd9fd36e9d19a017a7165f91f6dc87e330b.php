<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>De Gouden Draak</title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">

    <!-- Javascript -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
</head>
<body>
<div id="app">
    <?php echo e($user ?? ''); ?>

    <!-- Here we placed our Vue Component with the router-view -->
    <vue-app></vue-app>
</div>
</body>
</html>
<?php /**PATH C:\Users\Martijn\Documents\Avans hogeschool\Blok8\WEBFS\DeGoudenDraak\resources\views/default.blade.php ENDPATH**/ ?>