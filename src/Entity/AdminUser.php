<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminUser
 *
 * @ORM\Table(name="admin_user", uniqueConstraints={@ORM\UniqueConstraint(name="cu_username", columns={"au_username"})})
 * @ORM\Entity
 */
class AdminUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="au_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $auId;

    /**
     * @var string
     *
     * @ORM\Column(name="au_username", type="string", length=30, nullable=false)
     */
    private $auUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="au_password", type="string", length=32, nullable=false, options={"fixed"=true,"comment"="Hash MD5"})
     */
    private $auPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="au_lastlogin", type="datetime", nullable=false)
     */
    private $auLastlogin;

    public function getAuId(): ?int
    {
        return $this->auId;
    }

    public function getAuUsername(): ?string
    {
        return $this->auUsername;
    }

    public function setAuUsername(string $auUsername): self
    {
        $this->auUsername = $auUsername;

        return $this;
    }

    public function getAuPassword(): ?string
    {
        return $this->auPassword;
    }

    public function setAuPassword(string $auPassword): self
    {
        $this->auPassword = $auPassword;

        return $this;
    }

    public function getAuLastlogin(): ?\DateTimeInterface
    {
        return $this->auLastlogin;
    }

    public function setAuLastlogin(\DateTimeInterface $auLastlogin): self
    {
        $this->auLastlogin = $auLastlogin;

        return $this;
    }


}
