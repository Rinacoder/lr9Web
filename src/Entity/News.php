<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'datetime')]
    private $date_added;

    #[ORM\Column(type: 'text')]
    private $annotation;

    #[ORM\Column(type: 'text')]
    private $news_text;

    #[ORM\Column(type: 'integer')]
    private $number_of_views;

    #[ORM\Column(type: 'string', length: 255)]
    private $photo;

    #[ORM\OneToMany(mappedBy: 'news', targetEntity: Comment::class, orphanRemoval: true)]
    private $comments;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'news')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    public function __toString(): string
    {
        return (string) $this->getNumberOfViews();
    }

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getAnnotation(): ?string
    {
        return $this->annotation;
    }

    public function setAnnotation(string $annotation): self
    {
        $this->annotation = $annotation;

        return $this;
    }

    public function getNewsText(): ?string
    {
        return $this->news_text;
    }

    public function setNewsText(string $news_text): self
    {
        $this->news_text = $news_text;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->number_of_views;
    }

    public function setNumberOfViews(int $number_of_views): self
    {
        $this->number_of_views = $number_of_views;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setNews($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getNews() === $this) {
                $comment->setNews(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
