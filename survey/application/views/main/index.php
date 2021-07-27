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
        <div class="g-recaptcha form-field"></div>
        <button type="submit">Submit</button>
    </div>
</form>
<script type="text/javascript">
var onloadCallback = function() {
    var captchaContainer = document.querySelector('.g-recaptcha');
    grecaptcha.render(captchaContainer, {
    'sitekey' : '<?php echo $recaptcha_public_key; ?>'
    });
    document.querySelector('button[type="submit"]').disabled = false;
};
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en&onload=onloadCallback&render=explicit" async defer></script>
