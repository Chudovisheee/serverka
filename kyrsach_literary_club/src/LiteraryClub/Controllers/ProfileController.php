<?php
namespace LiteraryClub\Controllers;

use LiteraryClub\Models\User;
use LiteraryClub\View\View;

class ProfileController
{
    private $view;
    
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../public');
    }
    
    public function edit()
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? 1;
        $user = User::getById($userId);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->setNickname($_POST['nickname'] ?? $user->getNickname());
            $user->setEmail($_POST['email'] ?? $user->getEmail());
            $user->setBio($_POST['bio'] ?? '');
            
            if (!empty($_FILES['avatar']['name'])) {
                $uploadDir = __DIR__ . '/../../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $fileName);
                $user->setAvatar($fileName);
            }
            
            $user->save();
            header('Location: /php/kyrsach_literary_club/public/profile/edit?success=1');
            return;
        }
        
        $this->view->renderHtml('profile/edit.php', [
            'user' => $user,
            'title' => 'Редактирование профиля'
        ]);
    }
}