<?php

namespace App\Entity;

use App\Enum\AccountStatus;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(enumType: AccountStatus::class)]
    private ?AccountStatus $account_status = null;

    #[ORM\ManyToOne(inversedBy: 'user_id')]
    private ?Playlist $playlist = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?subscription $current_subscription_id = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'user_id', orphanRemoval: true)]
    private Collection $comments;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'user_id')]
    private Collection $playlistSubscriptions;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?WatchHistory $watchHistory = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->playlistSubscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getAccountStatus(): ?AccountStatus
    {
        return $this->account_status;
    }

    public function setAccountStatus(AccountStatus $account_status): static
    {
        $this->account_status = $account_status;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getCurrentSubscriptionId(): ?subscription
    {
        return $this->current_subscription_id;
    }

    public function setCurrentSubscriptionId(subscription $current_subscription_id): static
    {
        $this->current_subscription_id = $current_subscription_id;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUserId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUserId() === $this) {
                $comment->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setUserId($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getUserId() === $this) {
                $playlistSubscription->setUserId(null);
            }
        }

        return $this;
    }

    public function getWatchHistory(): ?WatchHistory
    {
        return $this->watchHistory;
    }

    public function setWatchHistory(?WatchHistory $watchHistory): static
    {
        // unset the owning side of the relation if necessary
        if ($watchHistory === null && $this->watchHistory !== null) {
            $this->watchHistory->setUserId(null);
        }

        // set the owning side of the relation if necessary
        if ($watchHistory !== null && $watchHistory->getUserId() !== $this) {
            $watchHistory->setUserId($this);
        }

        $this->watchHistory = $watchHistory;

        return $this;
    }
}
