<?php if (isset($errors)) {
    echo $errors;
}
?>
<form action="/report/login" method="POST" class="suvery-form">
    <div class="row">
        <label for="username">username: </label>
        <input type="text" name="username" id="username" required >
    </div>
    <div class="row">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required >
    </div>
    <div class="row">
        <button type="submit">Submit</button>
    </div>
</form>
