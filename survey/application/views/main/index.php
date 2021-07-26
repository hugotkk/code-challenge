<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
        <title><?php echo $title ?></title>
    </head>
    <body>
        <?php if (isset($errors)) {
            echo $errors;
        }
        ?>
        <form action="/" method="POST" class="suvery-form">
            <div class="row">
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" required value="<?php echo $post_data['name'] ?>">
            </div>
            <div class="row">
                <label for="email">Email Address: </label>
                <input type="email" name="email" id="email" required value="<?php echo $post_data['email'] ?>">
            </div>
            <div class="row">
                <label for="color">Favourite Colors: </label>
                <br/>
                <?php foreach($colors as $id => $color): ?>
                <input type="checkbox" name="colors[]" id="<?php echo $id ?>" value="<?php echo $id ?>" <?php echo in_array($id, $post_data['colors']) ? ' checked' : '' ?> />
                <label for="<?php echo $id ?>"><?php echo $color['name'] ?></label>
                <br/>
                <?php endforeach ?>
            </div>
            <div class="row">
                <button type="submit">Submit</button>
            </div>
        </form>
    </body>
</html>
