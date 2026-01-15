<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'page_slug', 
        'header_image', 
        'subtitle_1', 
        'subtitle_2', 
        'subtitle_3',
        'background_type',
        'background_value',
        'share_enabled',
        'qr_enabled',
        'view_count',
        'ios_app_url',
        'android_app_url',
        'ios_app_image',
        'android_app_image'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getPageBySlug($slug)
    {
        return $this->where('page_slug', $slug)->first();
    }
    
    public function getPageByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
    
    public function incrementViewCount($pageId)
    {
        $page = $this->find($pageId);
        if ($page) {
            $this->update($pageId, ['view_count' => ($page['view_count'] ?? 0) + 1]);
        }
    }
}

