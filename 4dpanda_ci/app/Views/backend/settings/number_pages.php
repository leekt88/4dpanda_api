<!DOCTYPE html>
<html>
<head>
    <title>Number Pages Content Settings</title>
    <meta name="robots" content="noindex"> 
    <meta name="robots" content="noindex,nofollow">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/admin.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CKEditor -->
    <script src="<?= base_url('/assets/js/ckeditor/ckeditor.js')?>"></script>
    <!-- elFinder -->
    <script src="<?= base_url('/assets/js/elfinder/js/elfinder.min.js')?>"></script>
    <style>
        .option-pair { margin-bottom: 10px; }
        /*.option-pair input:nth-child(1) {float:left; width:20%;}
        .option-pair input:nth-child(2) {float:left; width:60%;}
        */
        .settings-seo-options-container input {float:none !important; width:50% !important;}
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
            var container = document.getElementById('content-options-container');
            var seoOptionPair = document.createElement('div');
            seoOptionPair.className = 'option-pair';
            seoOptionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="content_option_name[]" placeholder="Nunber Page Name" required></div> ' +
                                      '<div class="option-content"><textarea class="ckeditor" name="content_option_value[]" placeholder="Content Value" required></textarea></div> ' +
                                      '<button type="button" onclick="removeOption(this)">Remove</button>';
            container.appendChild(seoOptionPair);
            CKEDITOR.replace(seoOptionPair.querySelector('.ckeditor'), {
                filebrowserBrowseUrl: '<?= base_url('elfinder'); ?>',
            });
        }
        
        
        function removeOption(button) {
            var container = document.getElementById('content-options-container');
            container.removeChild(button.parentNode);
        }

        function toggleOptionContent(optionName) {
            var optionPair = optionName.parentNode;
            optionPair.classList.toggle('active');
        }
        function initCKEditor() {
            document.querySelectorAll('.ckeditor').forEach(function(textarea) {
                if (!textarea.classList.contains('ckeditor-initialized')) {
                    CKEDITOR.replace(textarea, {
                        filebrowserBrowseUrl: '<?= base_url('elfinder'); ?>',
                    });
                    textarea.classList.add('ckeditor-initialized');
                }
            });
        }
        function destroyCKEditor() {
            document.querySelectorAll('.ckeditor-initialized').forEach(function(textarea) {
                if (CKEDITOR.instances[textarea.name]) {
                    CKEDITOR.instances[textarea.name].destroy();
                }
                textarea.classList.remove('ckeditor-initialized');
            });
        }
    </script>
</head>
<body>
    <div class="wrapper">
    <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="container">
            
            <h1 class="title">Number Page Content</h1>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>
            <form action="<?= site_url('/admin/settings/saveNumberPage') ?>" method="post" enctype="multipart/form-data" class="settings-form">
                    <div id="content-options-container" class="settings-content-options-container">
                        <?php if(isset($content_options) && is_array($content_options)): ?>
                            <?php foreach($content_options as $content_option): ?>
                                <div class="option-pair">
                                    <div class="option-name" onclick="toggleOptionContent(this)">
                                        <input type="text" name="content_option_name[]" value="<?= esc($content_option['option_name']) ?>" placeholder="Number Page Name" required> 
                                    </div>
                                    <div class="option-content">
                                        <textarea class="ckeditor" name="content_option_value[]" placeholder="Content Value" required><?= esc($content_option['option_value']) ?></textarea>
                                
                                        <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($content_option['option_name']) ?>', this, 'content-options-container')">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-add-content-option" onclick="addOption()">Add Page Content</button>
                    <?= $pagination ?>
                <button type="submit" class="btn-save-settings">Save Settings</button>
            </form>
        </div>
    </div>
</body>
</html>
