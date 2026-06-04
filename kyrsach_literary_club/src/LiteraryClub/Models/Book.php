<?php
namespace LiteraryClub\Models;

use LiteraryClub\Models\ActiveRecordEntity;
use LiteraryClub\Models\User;

interface Pricable {
    public function getPrice(): float;
    public function getDiscountedPrice(float $discount): float;
}

class Book extends ActiveRecordEntity implements Pricable
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $price;
    protected $cover;
    protected $createdAt;
    
    public function getName(): string { return $this->name ?? ''; }
    public function getText(): string { return $this->text ?? ''; }
    public function getAuthorId(): int { return $this->authorId ?? 0; }
    public function getPrice(): float { return (float)($this->price ?? 0); }
    public function getCover(): string { return $this->cover ?? 'default-cover.jpg'; }
    
    public function setPrice(float $price): void { $this->price = $price; }
    public function setName(string $name): void { $this->name = $name; }
    public function setText(string $text): void { $this->text = $text; }
    public function setCover(string $cover): void { $this->cover = $cover; }
    public function setAuthorId(int $authorId): void { $this->authorId = $authorId; }
    
    public function getDiscountedPrice(float $discount): float {
        return $this->getPrice() * (1 - $discount / 100);
    }
    
    public function getAuthor(): ?User {
        return User::getById($this->authorId);
    }
    
    protected static function getTableName(): string {
        return 'books';
    }
}