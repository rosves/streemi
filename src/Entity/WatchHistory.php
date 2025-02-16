<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class WatchHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_watched = null;

    #[ORM\Column]
    private ?int $number_of_view = null;

    #[ORM\OneToOne(inversedBy: 'watchHistory', cascade: ['persist', 'remove'])]
    private ?user $user_id = null;

    /**
     * @var Collection<int, media>
     */
    #[ORM\OneToMany(targetEntity: media::class, mappedBy: 'watchHistory')]
    private Collection $media_id;

    public function __construct()
    {
        $this->media_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWatched(): ?\DateTimeInterface
    {
        return $this->last_watched;
    }

    public function setLastWatched(\DateTimeInterface $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getNumberOfView(): ?int
    {
        return $this->number_of_view;
    }

    public function setNumberOfView(int $number_of_view): static
    {
        $this->number_of_view = $number_of_view;

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

    /**
     * @return Collection<int, media>
     */
    public function getMediaId(): Collection
    {
        return $this->media_id;
    }

    public function addMediaId(media $mediaId): static
    {
        if (!$this->media_id->contains($mediaId)) {
            $this->media_id->add($mediaId);
            $mediaId->setWatchHistory($this);
        }

        return $this;
    }

    public function removeMediaId(media $mediaId): static
    {
        if ($this->media_id->removeElement($mediaId)) {
            // set the owning side to null (unless already changed)
            if ($mediaId->getWatchHistory() === $this) {
                $mediaId->setWatchHistory(null);
            }
        }

        return $this;
    }
}
