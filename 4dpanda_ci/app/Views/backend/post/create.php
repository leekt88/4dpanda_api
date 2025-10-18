<!-- app/Views/posts/create.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="<?= base_url('/assets/js/ckeditor/ckeditor.js')?>"></script>
    <script src="<?= base_url('/assets/js/elfinder/js/elfinder.min.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('/assets/js/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') ?>">
    <script src="<?= base_url('/assets/js/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') ?>"></script>
    <script>hljs.initHighlightingOnLoad();</script>
<body>
    <div class="wrapper">
        <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="content">
            <h2>Add New Post</h2>
            <?= form_open_multipart('/admin/posts/store') ?>
            <!--<form action="/admin/posts/store" method="post">-->
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
                <label for="content">Content:</label>
                <textarea name="content" id="content"></textarea>
                <script>
                    CKEDITOR.replace('content', {
                        filebrowserBrowseUrl: '<?= base_url('/admin/elfinder/upload'); ?>',
                        allowedContent: true,  // Allow all HTML content
                        extraAllowedContent: 'pre[*]{*}(*)',  // Allow <pre> tags with any attributes, classes, and styles
                        removePlugins: 'easyimage,cloudservices',  // Remove plugins that might interfere with HTML content
                        extraPlugins: 'codesnippet', // Add CodeSnippet plugin
                        codeSnippet_theme: 'default', // Set CodeSnippet theme
                    });
                </script>
                <label for="category_id">Image:</label>
                <input type="file" name="image" accept="image/*">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="meta_title">Meta Title:</label>
                <input type="text" name="meta_title" id="meta_title">
                <label for="meta_description">Meta Description:</label>
                <textarea name="meta_description" id="meta_description"></textarea>
                <label for="meta_keywords">Meta Keywords:</label>
                <textarea name="meta_keywords" id="meta_keywords"></textarea>
                <label for="scripts">Scripts:</label>
                <textarea name="scripts" id="scripts"></textarea>
                <label for="uri">URI:</label>
                <input type="text" name="uri" id="uri">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</body>
</html>
