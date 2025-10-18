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
            <h2>Categories</h2>
            <a href="/admin/categories/create" class="btn btn-primary">Add New Category</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $category['name'] ?></td>
                            <td><?= $category['description'] ?></td>
                            <td><?= $category['slug'] ?></td>
                            <td>
                                <?php if($category['id']!=1):?>
                                    <a href="/admin/categories/edit/<?= $category['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/admin/categories/delete/<?= $category['id'] ?>" class="btn btn-danger" onclick="return confirmDelete()">Delete</a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post?');
        }
    </script>
</body>
</html>

