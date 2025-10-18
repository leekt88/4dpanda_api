<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;
use App\Models\LotteryModel;
use App\Models\SettingsModel;
class OtherPagesController extends Controller
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingsModel();
    }
    public function predictionIndex()
    {
        $uri = $this->getUri();
        $meta = $this->getMetaData($uri);
        $seo = $this->getSEOContent($uri);
        $ads = $this->getAdsLists();
        $h1 = $this->getH1Title($uri);
        $headings = $this->getHeadingLists($uri);
        return view('frontend/prediction', ["meta"=> $meta,"seo_content"=> $seo, "h1"=>$h1, 'ads'=>$ads]);
    }
    public function sitemapIndex(){
        $urls = $this->getSitemapUrls();

        // Tạo tài liệu XML
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $urlset = $xml->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $url) {
            $url_element = $xml->createElement('url');

            $loc = $xml->createElement('loc', base_url(str_replace("sitemap_","",$url['option_name']))); // Giả sử bảng có cột 'path'
            $url_element->appendChild($loc);
            $lastmod = $xml->createElement('lastmod', date('Y-m-d', strtotime($url['updated_at']))); // Giả sử bảng có cột 'last_modified'
            $url_element->appendChild($lastmod);

            $op = json_decode($url['option_value'], true);
            //var_dump($url['option_value']); exit();
            $changefreq = $xml->createElement('changefreq', $op['changefreq']);
            $url_element->appendChild($changefreq);

            $priority = $xml->createElement('priority', $op['priority']);
            $url_element->appendChild($priority);

            $urlset->appendChild($url_element);
        }

        $xml->appendChild($urlset);

        header('Content-Type: application/xml');
        echo $xml->saveXML();
        exit();
    }
    private function getSitemapUrls(){
        $data =  $this->settingModel->getSitemapUrls();
        return $data;
    }
    private function getMetaData($uri){
        return ($this->settingModel->getSiteMeta($uri));
    }  
    private function getSEOContent($uri){

        return ($this->settingModel->getSEOContent($uri));
    }
    private function getAdsLists(){

        return ($this->settingModel->getAdsLists());
    }
    private function getHeadingLists($uri){
        return ($this->settingModel->getHeadingLists($uri));
    }
    private function getH1Title($uri){
        return ($this->settingModel->getH1Title($uri));
    }
    private function getUri(){
        // Lấy đối tượng request
        $request = \Config\Services::request();
        // Lấy toàn bộ URL
        $fullUrl = $request->getUri();
        return str_replace("/","-",substr($fullUrl->getPath(),1));
    }
}
