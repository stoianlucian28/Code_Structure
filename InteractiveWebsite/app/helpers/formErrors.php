<?php if (count($errors) > 0): ?>
    <div class="alert alert-danger formAlert" role="alert">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

