<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function view($slug)
    {
        $page = $this->pageModel->getPageBySlug($slug);
        
        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Increment view count
        $this->pageModel->incrementViewCount($page['id']);
        
        $links = $this->linkModel->getLinksByPageId($page['id']);
        $carouselImages = $this->carouselModel->getCarouselImagesByPageId($page['id']);
        $socialLinks = $this->socialLinkModel->getSocialLinksByPageId($page['id']);
        
        $data = [
            'page' => $page,
            'links' => $links,
            'carouselImages' => $carouselImages,
            'socialLinks' => $socialLinks
        ];
        
        return view('landing/page', $data);
    }
    
    public function trackClick($linkId)
    {
        $link = $this->linkModel->find($linkId);
        
        if ($link) {
            // Increment click count
            $this->linkModel->incrementClickCount($linkId);
            
            // Log analytics
            $this->linkAnalyticsModel->logClick($linkId);
            
            // Redirect to the actual URL
            return redirect()->to($link['url']);
        }
        
        return redirect()->to('/');
    }
    
    public function generateQR($slug)
    {
        $page = $this->pageModel->getPageBySlug($slug);
        
        if (!$page) {
            return $this->response->setJSON(['error' => 'Page not found']);
        }
        
        $url = base_url($slug);
        
        // Return URL for QR code generation (will be handled by JavaScript)
        return $this->response->setJSON(['url' => $url]);
    }
}

