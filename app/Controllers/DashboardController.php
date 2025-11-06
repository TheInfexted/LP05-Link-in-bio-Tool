<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    protected function checkAuth()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/admin')->with('error', 'Please login first');
        }
        return null;
    }
    
    public function index()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        // Fetch analytics data
        $totalViews = $page['view_count'] ?? 0;
        $totalClicks = $this->linkAnalyticsModel->getTotalClicksByPageId($page['id']);
        $activeLinks = $this->linkModel->getActiveLinksCountByPageId($page['id']);
        $socialLinks = $this->socialLinkModel->getActiveSocialLinksCountByPageId($page['id']);
        
        $data = [
            'title' => 'Dashboard',
            'page' => $page,
            'user' => $this->session->get(),
            'analytics' => [
                'total_views' => $totalViews,
                'total_clicks' => $totalClicks,
                'active_links' => $activeLinks,
                'social_links' => $socialLinks
            ]
        ];
        
        return view('dashboard/index', $data);
    }
    
    public function settings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        $data = [
            'title' => 'Page Settings',
            'page' => $page
        ];
        
        return view('dashboard/settings', $data);
    }
    
    public function updateSettings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        $data = [
            'subtitle_1' => $this->request->getPost('subtitle_1'),
            'subtitle_2' => $this->request->getPost('subtitle_2'),
            'subtitle_3' => $this->request->getPost('subtitle_3'),
            'share_enabled' => $this->request->getPost('share_enabled') ? 1 : 0,
            'qr_enabled' => $this->request->getPost('qr_enabled') ? 1 : 0,
        ];
        
        // Handle header image upload
        $headerImage = $this->request->getFile('header_image');
        if ($headerImage && $headerImage->isValid()) {
            $newName = $headerImage->getRandomName();
            $headerImage->move(ROOTPATH . 'public/uploads/headers', $newName);
            $data['header_image'] = 'uploads/headers/' . $newName;
        }
        
        // Handle background image upload
        $backgroundImage = $this->request->getFile('background_image');
        if ($backgroundImage && $backgroundImage->isValid()) {
            $newName = $backgroundImage->getRandomName();
            $backgroundImage->move(ROOTPATH . 'public/uploads/backgrounds', $newName);
            $data['background_value'] = 'uploads/backgrounds/' . $newName;
            $data['background_type'] = 'image';
        }
        
        $this->pageModel->update($page['id'], $data);
        
        return redirect()->to('/admin/settings')->with('success', 'Settings updated successfully!');
    }
    
    public function removeBackground()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        if (!$page) {
            return $this->response->setJSON(['success' => false, 'message' => 'Page not found']);
        }
        
        // Remove background image
        $data = [
            'background_value' => null,
            'background_type' => 'gradient'
        ];
        
        $this->pageModel->update($page['id'], $data);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Background image removed successfully']);
    }
    
    public function links()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        $links = $this->linkModel->getLinksByPageId($page['id']);
        
        $data = [
            'title' => 'Manage Links',
            'links' => $links,
            'page' => $page
        ];
        
        return view('dashboard/links', $data);
    }
    
    public function addLink()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        // Get the highest position and add 1
        $links = $this->linkModel->getLinksByPageId($page['id']);
        $maxPosition = 0;
        foreach ($links as $link) {
            if ($link['position'] > $maxPosition) {
                $maxPosition = $link['position'];
            }
        }
        
        $data = [
            'page_id' => $page['id'],
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => null,
            'background_color' => $this->request->getPost('background_color') ?: '#000000',
            'text_color' => $this->request->getPost('text_color') ?: '#FFFFFF',
            'position' => $maxPosition + 1,
            'is_active' => 1
        ];
        
        $this->linkModel->insert($data);
        
        return redirect()->to('/admin/links')->with('success', 'Link added successfully!');
    }
    
    public function reorderLinks()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        // Check if it's an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }
        
        $json = $this->request->getJSON();
        $order = $json->order ?? [];
        
        if (empty($order)) {
            return $this->response->setJSON(['success' => false, 'message' => 'No order provided']);
        }
        
        // Update positions
        $position = 0;
        foreach ($order as $linkId) {
            $this->linkModel->update($linkId, ['position' => $position]);
            $position++;
        }
        
        return $this->response->setJSON(['success' => true, 'message' => 'Link order updated successfully']);
    }
    
    public function deleteLink($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $this->linkModel->delete($id);
        
        return redirect()->to('/admin/links')->with('success', 'Link deleted successfully!');
    }
    
    public function carousel()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        $images = $this->carouselModel->getCarouselImagesByPageId($page['id']);
        
        $data = [
            'title' => 'Manage Carousel',
            'images' => $images,
            'page' => $page
        ];
        
        return view('dashboard/carousel', $data);
    }
    
    public function addCarouselImage()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        if (!$page) {
            return redirect()->to('/admin/carousel')->with('error', 'Page not found');
        }
        
        $image = $this->request->getFile('image');
        
        if (!$image) {
            return redirect()->to('/admin/carousel')->with('error', 'No image uploaded');
        }
        
        if ($image->getError() !== 0) {
            return redirect()->to('/admin/carousel')->with('error', 'Upload error: ' . $image->getErrorString());
        }
        
        if (!$image->isValid()) {
            return redirect()->to('/admin/carousel')->with('error', 'Invalid image file');
        }
        
        try {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/carousel', $newName);
            
            // Get the highest position and add 1
            $images = $this->carouselModel->getCarouselImagesByPageId($page['id']);
            $maxPosition = 0;
            foreach ($images as $img) {
                if ($img['position'] > $maxPosition) {
                    $maxPosition = $img['position'];
                }
            }
            
            $data = [
                'page_id' => $page['id'],
                'image_path' => 'uploads/carousel/' . $newName,
                'caption' => $this->request->getPost('caption'),
                'position' => $maxPosition + 1,
                'is_active' => 1
            ];
            
            $this->carouselModel->insert($data);
            
            return redirect()->to('/admin/carousel')->with('success', 'Image added successfully!');
            
        } catch (\Exception $e) {
            return redirect()->to('/admin/carousel')->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    public function reorderCarousel()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }
        
        $json = $this->request->getJSON();
        $order = $json->order ?? [];
        
        if (empty($order)) {
            return $this->response->setJSON(['success' => false, 'message' => 'No order provided']);
        }
        
        $position = 0;
        foreach ($order as $imageId) {
            $this->carouselModel->update($imageId, ['position' => $position]);
            $position++;
        }
        
        return $this->response->setJSON(['success' => true, 'message' => 'Carousel order updated successfully']);
    }
    
    public function deleteCarouselImage($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $this->carouselModel->delete($id);
        
        return redirect()->to('/admin/carousel')->with('success', 'Image deleted successfully!');
    }
    
    public function social()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        $socialLinks = $this->socialLinkModel->getSocialLinksByPageId($page['id']);
        
        $data = [
            'title' => 'Manage Social Links',
            'socialLinks' => $socialLinks,
            'page' => $page
        ];
        
        return view('dashboard/social', $data);
    }
    
    public function addSocialLink()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $page = $this->pageModel->getPageByUserId($userId);
        
        // Get the highest position and add 1
        $socialLinks = $this->socialLinkModel->getSocialLinksByPageId($page['id']);
        $maxPosition = 0;
        foreach ($socialLinks as $social) {
            if ($social['position'] > $maxPosition) {
                $maxPosition = $social['position'];
            }
        }
        
        $data = [
            'page_id' => $page['id'],
            'platform' => $this->request->getPost('platform'),
            'url' => $this->request->getPost('url'),
            'position' => $maxPosition + 1,
            'is_active' => 1
        ];
        
        $this->socialLinkModel->insert($data);
        
        return redirect()->to('/admin/social')->with('success', 'Social link added successfully!');
    }
    
    public function reorderSocial()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }
        
        $json = $this->request->getJSON();
        $order = $json->order ?? [];
        
        if (empty($order)) {
            return $this->response->setJSON(['success' => false, 'message' => 'No order provided']);
        }
        
        $position = 0;
        foreach ($order as $socialId) {
            $this->socialLinkModel->update($socialId, ['position' => $position]);
            $position++;
        }
        
        return $this->response->setJSON(['success' => true, 'message' => 'Social links order updated successfully']);
    }
    
    public function deleteSocialLink($id)
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $this->socialLinkModel->delete($id);
        
        return redirect()->to('/admin/social')->with('success', 'Social link deleted successfully!');
    }
    
    public function userSettings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);
        
        $data = [
            'title' => 'User Settings',
            'user' => $user
        ];
        
        return view('dashboard/user', $data);
    }
    
    public function updateUserSettings()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;
        
        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);
        
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        // Validate username and email are not empty
        if (empty($username) || empty($email)) {
            return redirect()->to('/admin/user')->with('error', 'Username and email are required!');
        }
        
        // Check if email is already taken by another user
        if ($email !== $user['email']) {
            $existingUser = $this->userModel->where('email', $email)->first();
            if ($existingUser && $existingUser['id'] !== $userId) {
                return redirect()->to('/admin/user')->with('error', 'Email is already taken!');
            }
        }
        
        // Check if username is already taken by another user
        if ($username !== $user['username']) {
            $existingUser = $this->userModel->where('username', $username)->first();
            if ($existingUser && $existingUser['id'] !== $userId) {
                return redirect()->to('/admin/user')->with('error', 'Username is already taken!');
            }
        }
        
        $data = [
            'username' => $username,
            'email' => $email
        ];
        
        // Handle password change
        if (!empty($newPassword)) {
            // Validate current password
            if (empty($currentPassword)) {
                return redirect()->to('/admin/user')->with('error', 'Current password is required to change password!');
            }
            
            if (!password_verify($currentPassword, $user['password'])) {
                return redirect()->to('/admin/user')->with('error', 'Current password is incorrect!');
            }
            
            // Validate new password
            if (strlen($newPassword) < 8) {
                return redirect()->to('/admin/user')->with('error', 'New password must be at least 8 characters!');
            }
            
            if ($newPassword !== $confirmPassword) {
                return redirect()->to('/admin/user')->with('error', 'New passwords do not match!');
            }
            
            // Password will be hashed by UserModel's beforeUpdate hook
            $data['password'] = $newPassword;
        }
        
        $this->userModel->update($userId, $data);
        
        // Update session email if changed
        if ($email !== $user['email']) {
            $this->session->set('email', $email);
        }
        
        return redirect()->to('/admin/user')->with('success', 'User settings updated successfully!');
    }
}

