<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
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
            var container = document.getElementById('options-container');
            var optionPair = document.createElement('div');
            optionPair.className = 'option-pair';
            optionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="special_draw_option_name[]" placeholder="Option Name" required> </div>' +
                                   '<div class="option-content"><input type="text" name="special_draw_option_value[]" placeholder="Option Value" required> </div>' +
                                   '<button type="button" onclick="removeOption(this)">Remove</button>';
            container.appendChild(optionPair);
        }
        function addLotoOption() {
            var container = document.getElementById('loto-options-container');
            var optionPair = document.createElement('div');
            optionPair.className = 'option-pair';
            optionPair.innerHTML = '<input type="text" name="loto_option_name[]" placeholder="Loto Key" required>' +
                                   '<input type="text" name="loto_option_value[]" placeholder="Loto Name" required>' +
                                   '<label><input type="checkbox" name="loto_option_status[]"> Status</label>' +
                                    '<input type="text" name="loto_option_note[]" placeholder="Link to scrawler">' +
                                   '<button type="button" onclick="removeLotoOption(this)">Remove</button>';
            container.appendChild(optionPair);
        }

        function removeOption(button) {
            var container = document.getElementById('options-container');
            container.removeChild(button.parentNode);
        }
        function removeLotoOption(button) {
            var container = document.getElementById('loto-options-container');
            container.removeChild(button.parentNode);
        }       
        function toggleOptionContent(optionName) {
            var optionPair = optionName.parentNode;
            optionPair.classList.toggle('active');
        }
        function showTab(tabIndex) {
            var tabContents = document.querySelectorAll('.tab-content');
            var tabs = document.querySelectorAll('.tabs button');
            tabContents.forEach(function(content, index) {
                content.classList.toggle('active', index === tabIndex);
                if (content.classList.contains('active') && content.classList.contains('seo-tab')) {
                    initCKEditor();
                } else {
                    destroyCKEditor();
                }
            });
            tabs.forEach(function(tab, index) {
                tab.classList.toggle('active', index === tabIndex);
            });
        }
        function initCKEditor() {
            document.querySelectorAll('.ckeditor').forEach(function(textarea) {
                if (!textarea.classList.contains('ckeditor-initialized')) {
                    CKEDITOR.replace(textarea, {
                        filebrowserBrowseUrl: '<?= base_url('elfinder'); ?>',
                        allowedContent: true,  // Allow all HTML content
                        extraAllowedContent: 'pre[*]{*}(*)',  // Allow <pre> tags with any attributes, classes, and styles
                        removePlugins: 'easyimage,cloudservices',  // Remove plugins that might interfere with HTML content
                        extraPlugins: 'codesnippet', // Add CodeSnippet plugin
                        codeSnippet_theme: 'default', // Set CodeSnippet theme
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

        document.addEventListener('DOMContentLoaded', function() {
            showTab(0); // Show the first tab by default
        });

        function ensureAllCheckboxesAreSent() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="special_draw_option_status[]"]');
            checkboxes.forEach(function(checkbox) {
                if (!checkbox.checked) {
                    checkbox.checked = true;
                    checkbox.value = "0";
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('.settings-form');
            form.addEventListener('submit', ensureAllCheckboxesAreSent);
        });
    </script>
</head>
<body>
    <div class="wrapper">
    <?= $this->include('backend/template_parts/sidebar') ?>
        <div class="container">
            
            <h1 class="title">Site Settings</h1>

            <?php if(session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>
            <div class="tabs">
                <button type="button" class="tab-link active" onclick="showTab(0)">Special Draw</button>
                <button type="button" class="tab-link active" onclick="showTab(1)">Lottery Scrawler Link</button>
            </div>
            <form action="<?= site_url('/admin/lottery/savelottery') ?>" method="post" enctype="multipart/form-data" class="settings-form">
                <div class="tab-content active">
                    <div id="options-container" class="settings-options-container">
                            <?php if(isset($options) && is_array($options)): ?>
                                <?php foreach($options as $option): ?>
                                    <div class="option-pair">  
                                        <div class="option-name" onclick="toggleOptionContent(this)">
                                            <input type="text" name="special_draw_option_name[]" value="<?= esc($option['option_name']) ?>" placeholder="Option Name" required> 
                                        </div>
                                        <div class="option-content">
                                            <input type="text" name="special_draw_option_value[]" value="<?= esc($option['option_value']) ?>" placeholder="Option Value" required> 
                                            <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($option['option_name']) ?>', this, 'options-container')">Delete</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn-add-option" onclick="addOption()">Add Option</button>
                        <?= $pagination ?>
                </div>
                <div class="tab-content">
                    <div id="loto-options-container" class="settings-loto-options-container">
                        <?php if(isset($loto_options) && is_array($loto_options)): ?>
                            <?php foreach($loto_options as $option): ?>
                                <div class="option-pair">
                                <div class="option-name" onclick="toggleOptionContent(this)">  
                                    <input type="text" name="loto_option_name[]" value="<?= esc($option['option_name']) ?>" placeholder="Loto Key" required>
                                </div> 
                                <div class="option-content">
                                    <input type="text" name="loto_option_value[]" value="<?= esc($option['option_value']) ?>" placeholder="Loto Name" required> 
                                    <label>
                                        <input type="checkbox" name="loto_option_status[]" <?= $option['status'] ? 'checked' : '' ?>>
                                    </label>
                                    <input type="text" name="loto_option_note[]" value="<?= esc($option['note']) ?>" placeholder="Link to scrawler" required>
                                    <!--<button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($option['option_name']) ?>', this, 'options-container')">Delete</button>-->
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-add-option" onclick="addLotoOption()">Add Loto</button>
                    <?= $loto_pagination ?>
                </div>
                <button type="submit" class="btn-save-settings">Save Settings</button>
            </form>
        </div>
    </div>
</body>
</html>
