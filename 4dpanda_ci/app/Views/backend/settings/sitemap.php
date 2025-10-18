<!DOCTYPE html>
<html>
<head>
    <title>Sitemap Settings</title>
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/admin.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CKEditor -->
    <script src="<?= base_url('/assets/js/ckeditor/ckeditor.js')?>"></script>
    <!-- elFinder -->
    <script src="<?= base_url('/assets/js/elfinder/js/elfinder.min.js')?>"></script>
    <!-- jQuery and jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .option-pair { margin-bottom: 10px; cursor: move; padding: 10px; border: 1px solid #ddd; }
        .settings-seo-options-container input { float: none !important; width: 50% !important; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .tabs { margin-bottom: 20px; }
        .tabs button { background: #ddd; border: none; padding: 10px; cursor: pointer; }
        .tabs button.active { background: #25aae2; color: #fff; }
        .pagination { display: flex; justify-content: center; margin-top: 20px; }
        .pagination a { margin: 0 5px; padding: 10px 15px; border: 1px solid #ddd; text-decoration: none; }
        .pagination a.active { background: #25aae2; color: #fff; }
        .option-content { display: none; padding: 10px; }
        .option-pair.active .option-content { display: block; }
    </style>
</head>
<body>
    <div class="wrapper">
    <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="container">
            <h1 class="title">Sitemap Management</h1>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>
            <form action="<?= site_url('/admin/sitemap/saveSitemap') ?>" method="post" enctype="multipart/form-data" class="settings-form">
                <div id="sitemap-options-container" class="settings-sitemap-options-container">
                    <?php if(isset($sitemap_options) && is_array($sitemap_options)): ?>
                        <?php foreach($sitemap_options as $sitemap_option): ?>
                            <div class="option-pair" data-id="<?= esc($sitemap_option['id']) ?>">
                                <div class="option-name" onclick="toggleOptionContent(this)">
                                    <input type="text" name="url_name[]" value="<?= esc(str_replace("sitemap_","",$sitemap_option['option_name'])) ?>" placeholder="URL" required> 
                                </div>
                                <div class="option-content">
                                    <textarea class="" name="url_value[]" placeholder="{changefreq:daily;priority:1}" required><?= esc($sitemap_option['option_value']) ?></textarea>
                                    <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($sitemap_option['option_name']) ?>', this, 'sitemap-options-container')">Delete</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn-add-content-option" onclick="addOption()">Add URL</button>
                <?= $pagination ?>
                <button type="submit" class="btn-save-settings">Save Settings</button>
            </form>
        </div>
    </div>

    <script>
        function deleteOption(optionName, button, containerId) {
            if (!confirm('Are you sure you want to delete this option?')) {
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= site_url('/admin/settings/deleteOption') ?>", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === 'success') {
                        var container = document.getElementById(containerId);
                        container.removeChild(button.parentNode.parentNode);
                    } else {
                        alert('Failed to delete option.');
                    }
                }
            };
            xhr.send("option_name=" + encodeURIComponent(optionName));
        }

        function addOption() {
            var container = document.getElementById('sitemap-options-container');
            var seoOptionPair = document.createElement('div');
            seoOptionPair.className = 'option-pair';
            seoOptionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="url_name[]" placeholder="URL" required></div> ' +
                                      '<div class="option-content"><textarea class="" name="url_value[]" placeholder="{changefreq:daily;priority:1}" required></textarea></div> ' +
                                      '<button type="button" onclick="removeOption(this)">Remove</button>';
            container.appendChild(seoOptionPair);
        }

        function removeOption(button) {
            var container = document.getElementById('sitemap-options-container');
            container.removeChild(button.parentNode);
        }

        function toggleOptionContent(optionName) {
            var optionPair = optionName.parentNode;
            optionPair.classList.toggle('active');
        }

        $(document).ready(function() {
            $("#sitemap-options-container").sortable({
                update: function(event, ui) {
                    var sortedIDs = $("#sitemap-options-container").sortable("toArray", { attribute: "data-id" });
                    console.log(sortedIDs); // Đây là thứ tự mới của các tùy chọn, bạn có thể gửi nó đến máy chủ để lưu trữ

                    // Gửi thứ tự mới đến máy chủ bằng Ajax
                    $.ajax({
                        url: '<?= site_url('/admin/sitemap/updateOrder') ?>',
                        method: 'POST',
                        data: { order: sortedIDs },
                        success: function(response) {
                            // Xử lý phản hồi từ máy chủ nếu cần
                            console.log("Order updated successfully");
                        },
                        error: function(xhr, status, error) {
                            // Xử lý lỗi nếu có
                            console.error("Error updating order: " + error);
                        }
                    });
                }
            });
            $("#sitemap-options-container").disableSelection();
        });
    </script>
</body>
</html>
