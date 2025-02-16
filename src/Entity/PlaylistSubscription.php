<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $subscribed_at = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    private ?user $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    private ?playlist $playlist_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscribedAt(): ?\DateTimeInterface
    {
        return $this->subscribed_at;
    }

    public function setSubscribedAt(\DateTimeInterface $subscribed_at): static
    {
        $this->subscribed_at = $subscribed_at;

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

    public function getPlaylistId(): ?playlist
    {
        return $this->playlist_id;
    }

    public function setPlaylistId(?playlist $playlist_id): static
    {
        $this->playlist_id = $playlist_id;

        return $this;
    }
}
