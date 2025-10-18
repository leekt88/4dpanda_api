<!-- app/Views/categories/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <title>Add Category</title>
    <link rel="stylesheet" href="/assets/css/admin.css">

      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <div class="wrapper">
        <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="content">
            <h2>Create New Category</h2>
            <form action="/admin/categories/store" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</body>
</html>