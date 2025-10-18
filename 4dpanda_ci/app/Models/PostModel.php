<?php
// app/Models/PostModel.php
namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'content', 'image', 'category_id', 'meta_title', 'meta_description', 
        'meta_
        keywords', 'scripts', 'uri'
    ];
    public function get_latest_posts_by_cat($limit, $cat) {
        $query = $this->where('category_id',$cat)
                        ->orderBy('id', 'DESC')
                        ->select('id, uri, category_id, image, title');
                        //->limit((int)$limit);
                        //->get('posts');
        return $query->findAll((int)$limit);
    }
}
