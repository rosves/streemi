<?php

namespace App\Entity;

use App\Enum\MediaType;
use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'media_type', type: 'string')]
#[ORM\DiscriminatorMap(['Serie' => Serie::class, 'Movie' => Movie::class])]

class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: MediaType::class)]
    private ?MediaType $media_type = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $long_description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover_image = null;

    #[ORM\Column(nullable: true)]
    private ?array $staff = null;

    #[ORM\Column(nullable: true)]
    private ?array $caste = null;

    #[ORM\ManyToOne(inversedBy: 'media_id')]
    private ?WatchHistory $watchHistory = null;

    /**
     * @var Collection<int, categorie>
     */
    #[ORM\ManyToMany(targetEntity: categorie::class, inversedBy: 'media')]
    private Collection $categories;

    /**
     * @var Collection<int, language>
     */
    #[ORM\ManyToMany(targetEntity: language::class, inversedBy: 'media')]
    private Collection $languages;

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'media_id')]
    private Collection $playlistMedia;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->playlistMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaType(): ?MediaType
    {
        return $this->media_type;
    }

    public function setMediaType(MediaType $media_type): static
    {
        $this->media_type = $media_type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): static
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(?string $long_description): static
    {
        $this->long_description = $long_description;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(?string $cover_image): static
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getStaff(): ?array
    {
        return $this->staff;
    }

    public function setStaff(?array $staff): static
    {
        $this->staff = $staff;

        return $this;
    }

    public function getCaste(): ?array
    {
        return $this->caste;
    }

    public function setCaste(?array $caste): static
    {
        $this->caste = $caste;

        return $this;
    }

    public function getWatchHistory(): ?WatchHistory
    {
        return $this->watchHistory;
    }

    public function setWatchHistory(?WatchHistory $watchHistory): static
    {
        $this->watchHistory = $watchHistory;

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(categorie $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(language $language): static
    {
        $this->languages->removeElement($language);

        return $this;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setMediaId($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getMediaId() === $this) {
                $playlistMedium->setMediaId(null);
            }
        }

        return $this;
    }
}
