<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkAnalyticsModel extends Model
{
    protected $table = 'link_analytics';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'link_id',
        'ip_address',
        'user_agent',
        'referrer'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'clicked_at';
    protected $updatedField = '';
    
    public function logClick($linkId)
    {
        $data = [
            'link_id' => $linkId,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'referrer' => $_SERVER['HTTP_REFERER'] ?? null
        ];
        
        return $this->insert($data);
    }
    
    public function getTotalClicksByPageId($pageId)
    {
        return $this->select('COUNT(*) as total')
                    ->join('links', 'links.id = link_analytics.link_id')
                    ->where('links.page_id', $pageId)
                    ->get()
                    ->getRow()
                    ->total ?? 0;
    }
}

