<?php
namespace LiteraryClub\Models;

use LiteraryClub\Models\ActiveRecordEntity;

class Review extends ActiveRecordEntity
{
    protected $bookId;
    protected $userId;
    protected $rating;
    protected $comment;
    protected $createdAt;
    
    public function getBookId(): int { return $this->bookId; }
    public function getUserId(): int { return $this->userId; }
    public function getRating(): int { return $this->rating; }
    public function getComment(): string { return $this->comment ?? ''; }
    
    public function setRating(int $rating): void { $this->rating = $rating; }
    public function setComment(string $comment): void { $this->comment = $comment; }
    
    public function getUser(): ?User {
        return User::getById($this->userId);
    }
    
    public function getBook(): ?Book {
        return Book::getById($this->bookId);
    }
    
    protected static function getTableName(): string {
        return 'reviews';
    }
}