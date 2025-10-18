<!-- app/Views/users/index.php -->
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
        <?php if(session()->getFlashdata('msg')): ?>
                <div><?= session()->getFlashdata('msg') ?></div>
            <?php endif; ?>
            <h2>Users</h2>
            <a href="/admin/users/create">Add New User</a>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['username'] ?></td>
                            <td>
                                <a href="/admin/users/edit/<?= $user['id'] ?>">Edit</a>
                                <?php if($user['id']==0):?>
                                    <a href="/admin/users/delete/<?= $user['id'] ?>" onclick="return confirmDelete()">Delete</a>
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
