<!-- app/Views/auth/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex"> 
     <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LcHxwsqAAAAAMIVroIESOr6meCK-z59JSV6SiQ2"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcHxwsqAAAAAMIVroIESOr6meCK-z59JSV6SiQ2', {action: 'login'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
            });
        });
    </script>
</head>
<body>
    <div class="">
        <div class="container-2 ">
            <h2>Login</h2>
            <?php if(session()->getFlashdata('msg')): ?>
                <div style="color:red;"><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>
            <form action="/login/authenticate" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
