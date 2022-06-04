<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date_added;

    #[ORM\Column(type: 'text')]
    private $comment_text;

    #[ORM\Column(type: 'string', length: 255)]
    private $moderation_status;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: News::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private $news;

    public function __toString(): string
    {
       return (string) $this->setDateAdded();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->date_added;
    }

    public function setDateAdded(\DateTimeInterface $date_added): self
    {
        $this->date_added = $date_added;

        return $this;
    }

    public function getCommentText(): ?string
    {
        return $this->comment_text;
    }

    public function setCommentText(string $comment_text): self
    {
        $this->comment_text = $comment_text;

        return $this;
    }

    public function getModerationStatus(): ?string
    {
        return $this->moderation_status;
    }

    public function setModerationStatus(string $moderation_status): self
    {
        $this->moderation_status = $moderation_status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNews(): ?News
    {
        return $this->news;
    }

    public function setNews(?News $news): self
    {
        $this->news = $news;

        return $this;
    }
}
