<?php
namespace LiteraryClub\Models;

use LiteraryClub\Models\ActiveRecordEntity;

class Contact extends ActiveRecordEntity
{
    protected $surname;
    protected $name;
    protected $lastname;
    protected $gender;
    protected $birthDate;
    protected $phone;
    protected $address;
    protected $email;
    protected $comment;
    protected $createdAt;
    
    // Геттеры
    public function getSurname(): string { return $this->surname ?? ''; }
    public function getName(): string { return $this->name ?? ''; }
    public function getLastname(): string { return $this->lastname ?? ''; }
    public function getGender(): string { return $this->gender ?? ''; }
    public function getBirthDate(): string { return $this->birthDate ?? ''; }
    public function getPhone(): string { return $this->phone ?? ''; }
    public function getAddress(): string { return $this->address ?? ''; }
    public function getEmail(): string { return $this->email ?? ''; }
    public function getComment(): string { return $this->comment ?? ''; }
    
    // Сеттеры
    public function setSurname(string $surname): void { $this->surname = $surname; }
    public function setName(string $name): void { $this->name = $name; }
    public function setLastname(string $lastname): void { $this->lastname = $lastname; }
    public function setGender(string $gender): void { $this->gender = $gender; }
    public function setBirthDate(string $birthDate): void { $this->birthDate = $birthDate; }
    public function setPhone(string $phone): void { $this->phone = $phone; }
    public function setAddress(string $address): void { $this->address = $address; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setComment(string $comment): void { $this->comment = $comment; }
    
    public function getFullName(): string {
        return trim($this->surname . ' ' . $this->name . ' ' . $this->lastname);
    }
    
    protected static function getTableName(): string {
        return 'contacts';
    }
}