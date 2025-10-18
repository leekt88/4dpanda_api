<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'option_name';
    protected $allowedFields = ['option_name', 'option_value', 'option_type', 'status', 'note', 'position', 'updated_at'];

    public function getOption($name)
    {
        return $this->where('option_name', $name)->first();
    }

    public function updateOption($name, $value, $type, $status=1, $note='')
    {
        if ($this->getOption($name)) {
            return $this->where('option_name', $name)->set(['option_value' => $value, 'status'=> $status, 'note'=>$note])->update();
        } else {
            return $this->insert(['option_name' => $name, 'option_value' => $value, 'option_type' => $type, 'status'=>$status, 'note'=>$note]);
        }
    }
    public function updatePosition($id, $position) {
        return $this->where('id', $id)->set(['position' => $position])->update();
    }
    public function getDynamicOptions()
    {
        $options = $this->findAll();
        return array_filter($options, function ($option) {
            return !in_array($option['option_name'], ['default_site_title', 'default_site_description', 'default_site_keywords', 'default_site_script', 'logo_path', 'favicon_path']);
        });
    }
    /*
    * Get Page Meta Information 
    */
    public function getSiteMeta($url){
        if(!$url){
            $rows = $this->like('option_name', 'default_site_', 'after')->findAll();
            $str = 'default_site_';
        }
        else {
            $rows = $this->like('option_name', "$url".'_', 'after')->where('option_type','dynamic_option')->findAll();
            $meta_script = $this->where('option_name','default_site_script')->first();

            //var_dump($meta_script);exit();
            if(empty($rows)){
                $rows =  $this->like('option_name', 'default_site_', 'after')->findAll();
                $str = 'default_site_';
            }
            else {
                $str = $url.'_meta_';
            }
        }
        foreach ($rows as $key => $row) {
            $res[str_replace($str,"",$row['option_name'])] = $row['option_value'];
        }
        //var_dump($res);exit();
        if(!isset($res['script'])){
            $res['script'] = $meta_script['option_value']; // Set Script default to display
        }
        return $res;
    }
    /*
    * Get Page SEO Content
    */
    public function getSEOContent($url){
        if(!$url){
            $row = $this->where('option_name', 'home_seo_content')->first();
        }
        else {
            $row = $this->where('option_name', "$url".'_seo_content')->first();
        }
        return $row;
    }
    /*
    ** Get Ads Lists
    */
    public function getAdsLists(){
        $rows = $this->where(['option_type' =>'ads_option'])->findAll();
        $ads=[];
        foreach ($rows as $row){
            $ads[$row['option_name']] = $row['option_value'];
        }
        return $ads;
    }
    /*
    * Get Special Draw
    */
    public function getSpecialDraw(){ 
        $rows = $this->where(['option_type' =>'special_draw', 'option_name' => date("Y")])->first();
        return $rows;
    }
    public function deleteOption($optionName)
    {
        return $this->where('option_name', $optionName)->delete();
    }
    /*
    * Get Page SEO Content
    */
    public function getHeadingLists($url){
        $str = $url.'_';
        $rows = $this->like('option_name', "$url".'_heading_', 'after')->where('option_type','heading_option')->findAll();
        if(empty($rows)){
            $rows = $this->where('option_type', 'heading_option')->like('option_name','default_heading_', 'after')->findAll();
            $str = "default_";
        }
        $headings = [];
        foreach ($rows as $row){
            $headings[str_replace($str,"", $row['option_name'])] = $row['option_value'];
        }
        //var_dump($headings);
        return $headings;
    }   
    /*
    * Get H1 Title Draw
    */
    public function getH1Title($uri){ 
        $row = $this->where(['option_type' =>'heading_option'])->like('option_name', $uri."_h1_title")->first();
        return $row;
    } 
    /*
    * Get Sitemap URLs
    */
    public function getSitemapUrls(){
        $rows = $this->where(['option_type' =>'sitemap'])->orderBy('position','ASC')->findAll();
        return $rows;
    }
}