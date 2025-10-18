<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'default_site_title' => $this->settingModel->getOption('default_site_title')['option_value'] ?? '',
            'default_site_description' => $this->settingModel->getOption('default_site_description')['option_value'] ?? '',
            'default_site_keywords' => $this->settingModel->getOption('default_site_keywords')['option_value'] ?? '',
            'default_site_script' => $this->settingModel->getOption('default_site_script')['option_value'] ?? '',
            'logo_path' => $this->settingModel->getOption('logo_path')['option_value'] ?? '',
            'favicon_path' => $this->settingModel->getOption('favicon_path')['option_value'] ?? '',
            'options' => $this->settingModel->getDynamicOptions()
        ];
        // Phân trang cho Dynamic Options
        $page = $this->request->getVar('page') ?? 1;
        $perPage = 100;
        $options = $this->settingModel->where('option_type', 'dynamic_option')->paginate($perPage, 'default', $page);
        $data['options'] = $options;
        $data['pagination'] = $this->settingModel->pager->links();

        // Phân trang cho Page SEO Content
        $seoPage = $this->request->getVar('seo_page') ?? 1;
        $seoOptions = $this->settingModel->where('option_type', 'seo_option')->paginate($perPage, 'default', $seoPage);
        $data['seo_options'] = $seoOptions;
        $data['seo_pagination'] = $this->settingModel->pager->links();

        // Phân trang cho Page Ads Managment
        $adsPage = $this->request->getVar('ads_page') ?? 1;
        $adsOptions = $this->settingModel->where('option_type', 'ads_option')->paginate($perPage, 'default', $seoPage);
        $data['ads_options'] = $adsOptions;
        $data['ads_pagination'] = $this->settingModel->pager->links();
        
        // Phân trang cho Page Heading Managment
        $headingPage = $this->request->getVar('heading_page') ?? 1;
        $headingOptions = $this->settingModel->where('option_type', 'heading_option')->paginate($perPage, 'default', $headingPage);
        $data['heading_options'] = $headingOptions;
        $data['heading_pagination'] = $this->settingModel->pager->links();

        return view('backend/settings/settings', $data);

    }
    public function lotteryIndex(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
         // Phân trang cho Dynamic Options
         $page = $this->request->getVar('page') ?? 1;
         $perPage = 100;
         $options = $this->settingModel->where('option_type', 'special_draw')->paginate($perPage, 'default', $page);
         $data['options'] = $options;
         $data['pagination'] = $this->settingModel->pager->links();
         
        // Phân trang cho Loto Management
        $lotoPage = $this->request->getVar('loto_page') ?? 1;
        $lotoOptions = $this->settingModel->where('option_type', 'lottery_link')->paginate($perPage, 'default', $lotoPage);
        $data['loto_options'] = $lotoOptions;
        $data['loto_pagination'] = $this->settingModel->pager->links();
        return view('backend/settings/lottery', $data);
    }
    public function numberPagesIndex(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        // Phân trang cho Dynamic Options
        $page = $this->request->getVar('page') ?? 1;
        $perPage = 100;
        $options = $this->settingModel->where('option_type', 'number_pages_seo')->paginate($perPage, 'default', $page);
        $data['content_options'] = $options;
        $data['pagination'] = $this->settingModel->pager->links();
        return view('backend/settings/number_pages', $data);
    }
    public function sitemapAdminIndex(){
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin/login');
        }
        // Phân trang cho Dynamic Options
        $page = $this->request->getVar('page') ?? 1;
        $perPage = 100;
        $options = $this->settingModel->where('option_type', 'sitemap')->orderBy('position','ASC')->paginate($perPage, 'default', $page);
        $data['sitemap_options'] = $options;
        $data['pagination'] = $this->settingModel->pager->links();
        return view('backend/settings/sitemap', $data);
    }
    public function save()
    {
        $this->settingModel->updateOption('default_site_title', $this->request->getPost('default_site_title'),"default_option");
        $this->settingModel->updateOption('default_site_description', $this->request->getPost('default_site_description'), "default_option");
        $this->settingModel->updateOption('default_site_keywords', $this->request->getPost('default_site_keywords'), "default_option");
        $this->settingModel->updateOption('default_site_script', $this->request->getPost('default_site_script'), "default_option");

        if ($logo = $this->request->getFile('logo')) {
            if ($logo->isValid() && !$logo->hasMoved()) {
                $logoName = "logo.png";
                $logo->move(WRITEPATH . 'uploads', $logoName, true);
                $this->settingModel->updateOption('logo_path', 'uploads/' . $logoName, "default_option");
            }
        }

        if ($favicon = $this->request->getFile('favicon')) {
            if ($favicon->isValid() && !$favicon->hasMoved()) {
                $faviconName = "favicon.png";
                $favicon->move(WRITEPATH . 'uploads', $faviconName, true);
                $this->settingModel->updateOption('favicon_path', 'uploads/' . $faviconName, "default_option");
            }
        }

        // Save dynamic options
        $optionNames = $this->request->getPost('option_name');
        $optionValues = $this->request->getPost('option_value');
        
        if (is_array($optionNames) && is_array($optionValues)) {
            for ($i = 0; $i < count($optionNames); $i++) {
                $this->settingModel->updateOption($optionNames[$i], $optionValues[$i], "dynamic_option");
            }
        }

        // Save SEO content options
        $seoOptionNames = $this->request->getPost('seo_option_name');
        $seoOptionValues = $this->request->getPost('seo_option_value');

        if (is_array($seoOptionNames) && is_array($seoOptionValues)) {
            for ($i = 0; $i < count($seoOptionNames); $i++) {
                $this->settingModel->updateOption($seoOptionNames[$i], $seoOptionValues[$i], "seo_option");
            }
        }

        // Save Ads Management options
        $seoOptionNames = $this->request->getPost('ads_option_name');
        $seoOptionValues = $this->request->getPost('ads_option_value');

        if (is_array($seoOptionNames) && is_array($seoOptionValues)) {
            for ($i = 0; $i < count($seoOptionNames); $i++) {
                $this->settingModel->updateOption($seoOptionNames[$i], $seoOptionValues[$i], "ads_option");
            }
        }   
        
        // Save Heading Management options
        $headingOptionNames = $this->request->getPost('heading_option_name');
        $headingOptionValues = $this->request->getPost('heading_option_value');

        if (is_array($headingOptionNames) && is_array($headingOptionValues)) {
            for ($i = 0; $i < count($headingOptionNames); $i++) {
                $this->settingModel->updateOption($headingOptionNames[$i], $headingOptionValues[$i], "heading_option");
            }
        } 

        return redirect()->to('/admin/settings')->with('message', 'Settings updated successfully.');
    }
    public function saveLottery(){
        // Save Special Draw options
        $spDrawOptionNames = $this->request->getPost('special_draw_option_name');
        $spDrawOptionValues = $this->request->getPost('special_draw_option_value');

        if (is_array($spDrawOptionNames) && is_array($spDrawOptionValues)) {
            for ($i = 0; $i < count($spDrawOptionNames); $i++) {
                $this->settingModel->updateOption($spDrawOptionNames[$i], $spDrawOptionValues[$i], "special_draw");
            }
        }      
        // Save Special Draw options
        $lotoKeys = $this->request->getPost('loto_option_name');
        $lotoNames = $this->request->getPost('loto_option_value');
        $lotoStatus = $this->request->getPost('loto_option_status');
        $lotoLinks = $this->request->getPost('loto_option_note');
        //var_dump($lotoKeys);
        //var_dump($lotoNames);
        //var_dump($lotoStatus);
        //($lotoLinks);exit();
        if (is_array($lotoKeys) && is_array($lotoNames)&& is_array($lotoStatus) && is_array($lotoLinks)) {
            for ($i = 0; $i < count($lotoKeys); $i++) {
                //var_dump($lotoStatus[$i]);exit();
                $this->settingModel->updateOption($lotoKeys[$i], $lotoNames[$i], "lottery_link", $lotoStatus[$i]=="on"?1:0, $lotoLinks[$i]);
            }
        }           
        return redirect()->to('/admin/lottery')->with('message', 'Settings updated successfully.');
    }
    public function saveNumberPage(){
        // Save Special Draw options
        $contentOptionNames = $this->request->getPost('content_option_name');
        $contentOptionValues = $this->request->getPost('content_option_value');

        if (is_array($contentOptionNames) && is_array($contentOptionValues)) {
            for ($i = 0; $i < count($contentOptionNames); $i++) {
                $this->settingModel->updateOption($contentOptionNames[$i], $contentOptionValues[$i], "number_pages_seo");
            }
        }               
        return redirect()->to('/admin/number-pages')->with('message', 'Settings updated successfully.');
    }
    public function saveSitemap(){
        // Save Special Draw options
        $contentOptionNames = $this->request->getPost('url_name');
        $contentOptionValues = $this->request->getPost('url_value');

        if (is_array($contentOptionNames) && is_array($contentOptionValues)) {
            for ($i = 0; $i < count($contentOptionNames); $i++) {
                $this->settingModel->updateOption('sitemap_'.$contentOptionNames[$i], $contentOptionValues[$i], "sitemap");
            }
        }               
        return redirect()->to('/admin/sitemap')->with('message', 'Settings updated successfully.');
    }
    public function deleteOption()
    {
        $optionName = $this->request->getPost('option_name');
        if ($this->settingModel->where('option_name', $optionName)->delete()) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }
    public function updateOrder() {
        $order = $this->request->getPost('order');
        //var_dump($order);
        // Giả sử bạn có một model SettingsModel để cập nhật thứ tự
        if ($order) {
            foreach ($order as $position => $id) {
                $this->settingModel->updatePosition($id, $position);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}
