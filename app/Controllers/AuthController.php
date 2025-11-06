<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // If already logged in, redirect to dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to('/admin/dashboard');
        }
        
        return view('auth/login');
    }
    
    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $user = $this->userModel->verifyPassword($email, $password);
        
        if ($user) {
            $this->session->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
                'logged_in' => true
            ]);
            
            return redirect()->to('/admin/dashboard')->with('success', 'Login successful!');
        }
        
        return redirect()->back()->with('error', 'Invalid email or password');
    }
    
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin')->with('success', 'Logged out successfully');
    }
}

