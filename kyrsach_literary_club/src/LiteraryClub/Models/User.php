<?php
namespace LiteraryClub\Models;

use LiteraryClub\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $avatar;
    protected $bio;
    protected $createdAt;
    
    public function getNickname(): string { return $this->nickname ?? ''; }
    public function getEmail(): string { return $this->email ?? ''; }
    public function getRole(): string { return $this->role ?? 'user'; }
    public function getAvatar(): string { return $this->avatar ?? 'default-avatar.png'; }
    public function getBio(): string { return $this->bio ?? ''; }
    
    public function setNickname(string $nickname): void { $this->nickname = $nickname; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setBio(string $bio): void { $this->bio = $bio; }
    public function setAvatar(string $avatar): void { $this->avatar = $avatar; }
    
    public function isAdmin(): bool {
        return $this->role === 'admin';
    }
    
    protected static function getTableName(): string {
        return 'users';
    }
}