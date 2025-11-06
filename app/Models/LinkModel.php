<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table = 'links';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'page_id',
        'title',
        'url',
        'icon',
        'background_color',
        'text_color',
        'position',
        'is_active',
        'click_count'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getLinksByPageId($pageId)
    {
        return $this->where('page_id', $pageId)
                    ->where('is_active', 1)
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }
    
    public function incrementClickCount($linkId)
    {
        $link = $this->find($linkId);
        if ($link) {
            $this->update($linkId, ['click_count' => $link['click_count'] + 1]);
        }
    }
    
    public function getActiveLinksCountByPageId($pageId)
    {
        return $this->where('page_id', $pageId)
                    ->where('is_active', 1)
                    ->countAllResults();
    }
}

