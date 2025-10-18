<!-- app/Views/posts/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="<?= base_url('/assets/js/ckeditor/ckeditor.js')?>"></script>
    <script src="<?= base_url('/assets/js/elfinder/js/elfinder.min.js')?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('/assets/js/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css') ?>">
    <script src="<?= base_url('/assets/js/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') ?>"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="content">
            <h2>Edit Post</h2>
            <?= form_open_multipart("/admin/posts/update/".$post['id']); ?>
            <!--<form action="/admin/posts/update/<?= $post['id'] ?>" method="post">-->
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?= $post['title'] ?>">
                <label for="content">Content:</label>
                <textarea name="content" id="content"><?= $post['content'] ?></textarea>
                <script>
                    CKEDITOR.replace('content', {
                        filebrowserBrowseUrl: '<?= base_url('/admin/elfinder/upload'); ?>',
                        allowedContent: true,  // Allow all HTML content
                        extraAllowedContent: 'pre[*]{*}(*)',  // Allow <pre> tags with any attributes, classes, and styles
                        removePlugins: 'easyimage,cloudservices',  // Remove plugins that might interfere with HTML content
                        extraPlugins: 'codesnippet', // Add CodeSnippet plugin
                        codeSnippet_theme: 'default', // Set CodeSnippet theme
                        /*toolbar: [
                            { name: 'document', items: [ 'Source' ] },
                            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'Undo', 'Redo' ] },
                            { name: 'editing', items: [ 'Find', 'Replace', 'SelectAll' ] },
                            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat' ] },
                            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote' ] },
                            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak', 'CodeSnippet' ] },  // Add CodeSnippet button to the toolbar
                            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
                        ]*/
                    });
                </script>
                <label for="category_id">Image:</label>

                <?php if(isset($post['image']) && $post['image']!= base_url()): ?>
                    <div id="image-container">
                        <img src="<?= $post['image'];?>" width="80px" />
                        <button type="button" id="delete-image" data-post-id="<?= $post['id']; ?>" data-image-path="<?= $post['image']; ?>">Delete Image</button>
                    </div>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $post['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="meta_title">Meta Title:</label>
                <input type="text" name="meta_title" id="meta_title" value="<?= $post['meta_title'] ?>">
                <label for="meta_description">Meta Description:</label>
                <textarea name="meta_description" id="meta_description"><?= $post['meta_description'] ?></textarea>
                <label for="meta_keywords">Meta Keywords:</label>
                <textarea name="meta_keywords" id="meta_keywords"><?= $post['meta_keywords'] ?></textarea>
                <label for="scripts">Scripts:</label>
                <textarea name="scripts" id="scripts"><?= $post['scripts'] ?></textarea>
                <label for="uri">URI:</label>
                <input type="text" name="uri" id="uri" value="<?= $post['uri'] ?>">
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#delete-image').click(function() {
                var postId = $(this).data('post-id');
                var imagePath = $(this).data('image-path');
                
                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: '<?= base_url("/admin/posts/deleteImage") ?>',
                        type: 'POST',
                        data: {
                            post_id: postId,
                            image_path: imagePath
                        },
                        success: function(response) {
                            if (response === 'success') {
                                $('#image-container').remove();
                            } else {
                                alert('Failed to delete the image.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the image.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

