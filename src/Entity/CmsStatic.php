<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CmsStatic
 *
 * @ORM\Table(name="cms_static")
 * @ORM\Entity
 */
class CmsStatic
{
    /**
     * @var int
     *
     * @ORM\Column(name="cs_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $csId;

    /**
     * @var string
     *
     * @ORM\Column(name="cs_headtitle", type="string", length=250, nullable=false)
     */
    private $csHeadtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="cs_keywords", type="text", length=65535, nullable=false)
     */
    private $csKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="cs_description", type="text", length=65535, nullable=false)
     */
    private $csDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="cs_title", type="string", length=250, nullable=false)
     */
    private $csTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="cs_content", type="text", length=65535, nullable=false)
     */
    private $csContent;

    public function getCsId(): ?int
    {
        return $this->csId;
    }

    public function getCsHeadtitle(): ?string
    {
        return $this->csHeadtitle;
    }

    public function setCsHeadtitle(string $csHeadtitle): self
    {
        $this->csHeadtitle = $csHeadtitle;

        return $this;
    }

    public function getCsKeywords(): ?string
    {
        return $this->csKeywords;
    }

    public function setCsKeywords(string $csKeywords): self
    {
        $this->csKeywords = $csKeywords;

        return $this;
    }

    public function getCsDescription(): ?string
    {
        return $this->csDescription;
    }

    public function setCsDescription(string $csDescription): self
    {
        $this->csDescription = $csDescription;

        return $this;
    }

    public function getCsTitle(): ?string
    {
        return $this->csTitle;
    }

    public function setCsTitle(string $csTitle): self
    {
        $this->csTitle = $csTitle;

        return $this;
    }

    public function getCsContent(): ?string
    {
        return $this->csContent;
    }

    public function setCsContent(string $csContent): self
    {
        $this->csContent = $csContent;

        return $this;
    }


}
