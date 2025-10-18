<!-- app/Views/users/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <title>Users</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="content">
            <h2>Create New User</h2>
            <form action="/admin/users/store" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</body>
</html>