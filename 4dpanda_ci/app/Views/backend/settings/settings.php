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
            optionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="option_name[]" placeholder="Option Name" required> </div>' +
                                   '<div class="option-content"><input type="text" name="option_value[]" placeholder="Option Value" required> </div>' +
                                   '<button type="button" onclick="removeOption(this)">Remove</button>';
            container.appendChild(optionPair);
        }
        function addSeoOption() {
            var container = document.getElementById('seo-options-container');
            var seoOptionPair = document.createElement('div');
            seoOptionPair.className = 'option-pair';
            seoOptionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="seo_option_name[]" placeholder="SEO Option Name" required></div> ' +
                                      '<div class="option-content"><textarea class="ckeditor" name="seo_option_value[]" placeholder="SEO Option Value" required></textarea></div> ' +
                                      '<button type="button" onclick="removeSeoOption(this)">Remove</button>';
            container.appendChild(seoOptionPair);
            CKEDITOR.replace(seoOptionPair.querySelector('.ckeditor'), {
                        filebrowserBrowseUrl: '<?= base_url('/admin/elfinder/upload'); ?>',
                        allowedContent: true,  // Allow all HTML content
                        extraAllowedContent: 'pre[*]{*}(*)',  // Allow <pre> tags with any attributes, classes, and styles
                        removePlugins: 'easyimage,cloudservices',  // Remove plugins that might interfere with HTML content
                        extraPlugins: 'codesnippet', // Add CodeSnippet plugin
                        codeSnippet_theme: 'default', // Set CodeSnippet theme
            });
        }
        function addAdOption() {
            var container = document.getElementById('ads-options-container');
            var adOptionPair = document.createElement('div');
            adOptionPair.className = 'option-pair';
            adOptionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="ads_option_name[]" placeholder="Ads Option Name" required></div>' +
                                      '<div class="option-content"><textarea class="ckeditor" name="ads_option_value[]" placeholder="Ads Option Value" required></textarea></div>' +
                                      '<button type="button" onclick="removeAdsOption(this)">Remove</button>';
            container.appendChild(adOptionPair);
        }
        function addHeadingOption() {
            var container = document.getElementById('heading-options-container');
            var headOptionPair = document.createElement('div');
            headOptionPair.className = 'option-pair';
            headOptionPair.innerHTML = '<div class="option-name" onclick="toggleOptionContent(this)"><input type="text" name="heading_option_name[]" placeholder="Heading Name" required></div>' +
                                      '<div class="option-content"><input type="text" name="heading_option_value[]" placeholder="Heading Value" required></div>' +
                                      '<button type="button" onclick="removeHeadingOption(this)">Remove</button>';
            container.appendChild(headOptionPair);
        }
        function removeOption(button) {
            var container = document.getElementById('options-container');
            container.removeChild(button.parentNode);
        }
        function removeSeoOption(button) {
            var container = document.getElementById('seo-options-container');
            container.removeChild(button.parentNode);
        }
        function removeAdsOption(button) {
            var container = document.getElementById('ads-options-container');
            container.removeChild(button.parentNode);
        }
        function removeHeadingOption(button) {
            var container = document.getElementById('heading-options-container');
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
                        filebrowserBrowseUrl: '<?= base_url('/admin/elfinder/upload'); ?>',
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
                <button type="button" class="tab-link active" onclick="showTab(0)">Default Settings</button>
                <button type="button" class="tab-link" onclick="showTab(1)">Dynamic Settings</button>
                <button type="button" class="tab-link" onclick="showTab(2)">Pages' SEO Content</button>
                <button type="button" class="tab-link" onclick="showTab(3)">Heading Managment</button>
                <button type="button" class="tab-link" onclick="showTab(4)">Ads Management</button>

            </div>
            <form action="<?= base_url('/admin/settings/save') ?>" method="post" enctype="multipart/form-data" class="settings-form">
                <div class="tab-content active">
                    <div class="field">
                        <label for="default_site_title">Site Title</label>
                        <input type="text" name="default_site_title" value="<?= esc($default_site_title) ?>" required>
                    </div>

                    <div class="field">
                        <label for="default_site_description">Site Description</label>
                        <textarea name="default_site_description" required><?= esc($default_site_description) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="default_site_keywords">Keywords</label>
                        <input type="text" name="default_site_keywords" value="<?= esc($default_site_keywords) ?>">
                    </div>

                    <div class="field">
                        <label for="default_site_script">Script</label>
                        <textarea name="default_site_script" ><?= esc($default_site_script) ?></textarea>
                    </div>

                    <div class="field">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo">
                        <?php if($logo_path): ?>
                            <img src="<?= base_url($logo_path) ?>" alt="Site Logo" class="settings-logo">
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label for="favicon">Favicon</label>
                        <input type="file" name="favicon">
                        <?php if($favicon_path): ?>
                            <img src="<?= base_url($favicon_path) ?>" alt="Site Favicon" class="settings-favicon">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="options-container" class="settings-options-container">
                        <?php if(isset($options) && is_array($options)): ?>
                            <?php foreach($options as $option): ?>
                                <div class="option-pair">  
                                    <div class="option-name" onclick="toggleOptionContent(this)">
                                        <input type="text" name="option_name[]" value="<?= esc($option['option_name']) ?>" placeholder="Option Name" required> 
                                    </div>
                                    <div class="option-content">
                                        <input type="text" name="option_value[]" value="<?= esc($option['option_value']) ?>" placeholder="Option Value" required> 
                                    
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
                    <div id="seo-options-container" class="settings-seo-options-container">
                        <?php if(isset($seo_options) && is_array($seo_options)): ?>
                            <?php foreach($seo_options as $seo_option): ?>
                                <div class="option-pair">
                                <div class="option-name" onclick="toggleOptionContent(this)">
                                    <input type="text" name="seo_option_name[]" value="<?= esc($seo_option['option_name']) ?>" placeholder="SEO Option Name" required> 
                                </div>
                                <div class="option-content">
                                    <textarea class="ckeditor" name="seo_option_value[]" placeholder="SEO Option Value" required><?= esc($seo_option['option_value']) ?></textarea>
                                
                                    <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($seo_option['option_name']) ?>', this, 'seo-options-container')">Delete</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-add-seo-option" onclick="addSeoOption()">Add SEO Option</button>
                    <?= $seo_pagination ?>
                </div>
                <div class="tab-content">
                    <div id="heading-options-container" class="settings-heading-options-container">
                        <?php if(isset($heading_options) && is_array($heading_options)): ?>
                            <?php foreach($heading_options as $heading_option): ?>
                                <div class="option-pair">
                                <div class="option-name" onclick="toggleOptionContent(this)">
                                    <input type="text" name="heading_option_name[]" value="<?= esc($heading_option['option_name']) ?>" placeholder="Heading Name" required> 
                                </div>
                                <div class="option-content">
                                    <input type ="text" name="heading_option_value[]" placeholder="Heading Value" required value ="<?= esc($heading_option['option_value']) ?>">
                                
                                    <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($heading_option['option_name']) ?>', this, 'heading-options-container')">Delete</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-add-seo-option" onclick="addHeadingOption()">Add Heading Option</button>
                    <?= $heading_pagination ?>
                </div>
                <div class="tab-content">
                    <div id="ads-options-container" class="settings-ads-options-container">
                        <?php if(isset($ads_options) && is_array($ads_options)): ?>
                            <?php foreach($ads_options as $ads_option): ?>
                                <div class="option-pair">
                                    <div class="option-name" onclick="toggleOptionContent(this)">
                                        <input type="text" name="ads_option_name[]" value="<?= esc($ads_option['option_name']) ?>" placeholder="Ads Option Name" required>
                                    </div>
                                    <div class="option-content">
                                        <textarea name="ads_option_value[]" placeholder="Ads Option Value" required><?= esc($ads_option['option_value']) ?></textarea>
                                        
                                        <button type="button" class="btn-delete-option" onclick="deleteOption('<?= esc($ads_option['option_name']) ?>', this, 'ads-options-container')">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn-add-ad-option" onclick="addAdOption()">Add Ad Option</button>
                    <?= $ads_pagination ?>
                </div>
                <button type="submit" class="btn-save-settings">Save Settings</button>
            </form>
        </div>
    </div>
</body>
</html>
