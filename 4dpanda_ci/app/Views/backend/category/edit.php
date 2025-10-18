<!-- app/Views/categories/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="content">
            <h2>Edit Category</h2>
            <form action="/categories/update/<?= $category['id'] ?>" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?= $category['name'] ?>">
                <label for="description">Description:</label>
                <textarea name="description" id="description" value="<?= $category['description'] ?>"></textarea>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>