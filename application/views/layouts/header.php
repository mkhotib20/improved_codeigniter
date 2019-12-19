<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Igniter</title>
    <?= loadCss([
        'cscs.css'
    ]); ?>

</head>
<body>
<?php $this->load->view($view, $params); ?>
</body>
<?= loadJs([
    'cscs.js',
]); ?>
    
</html>