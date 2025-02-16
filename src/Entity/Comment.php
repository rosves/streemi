<?php

namespace App\Entity;

use App\Enum\CommentStatus;
use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(enumType: CommentStatus::class)]
    private ?CommentStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?media $media_id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'parent_comment_id')]
    private ?self $child_comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?CommentStatus
    {
        return $this->status;
    }

    public function setStatus(CommentStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMediaId(): ?media
    {
        return $this->media_id;
    }

    public function setMediaId(media $media_id): static
    {
        $this->media_id = $media_id;

        return $this;
    }

    public function getChildComment(): ?self
    {
        return $this->child_comment;
    }

    public function setChildComment(?self $child_comment): static
    {
        $this->child_comment = $child_comment;

        return $this;
    }
}
