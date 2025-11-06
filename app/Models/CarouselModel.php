<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $table = 'carousel_images';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'page_id',
        'image_path',
        'caption',
        'position',
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
    
    public function getCarouselImagesByPageId($pageId)
    {
        return $this->where('page_id', $pageId)
                    ->where('is_active', 1)
                    ->orderBy('position', 'ASC')
                    ->findAll();
    }
}

