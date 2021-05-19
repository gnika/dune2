<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreUrlrewrite
 *
 * @ORM\Table(name="core_urlrewrite")
 * @ORM\Entity
 */
class CoreUrlrewrite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="request_path", type="string", length=250, nullable=false)
     */
    private $requestPath;

    /**
     * @var string
     *
     * @ORM\Column(name="response_path", type="string", length=250, nullable=false)
     */
    private $responsePath;

    /**
     * @var int
     *
     * @ORM\Column(name="response_code", type="integer", nullable=false)
     */
    private $responseCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestPath(): ?string
    {
        return $this->requestPath;
    }

    public function setRequestPath(string $requestPath): self
    {
        $this->requestPath = $requestPath;

        return $this;
    }

    public function getResponsePath(): ?string
    {
        return $this->responsePath;
    }

    public function setResponsePath(string $responsePath): self
    {
        $this->responsePath = $responsePath;

        return $this;
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function setResponseCode(int $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }


}
