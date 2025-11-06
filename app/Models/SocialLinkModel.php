<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialLinkModel extends Model
{
    protected $table = 'social_links';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'page_id',
        'platform',
        'url',
        'position',
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    
    public function getSocialLinksByPageId($pageId)
    {
        return $this->where('page_id', $pageId)
                    ->where('is_active', 1)
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }
    
    public function getActiveSocialLinksCountByPageId($pageId)
    {
        return $this->where('page_id', $pageId)
                    ->where('is_active', 1)
                    ->countAllResults();
    }
}

