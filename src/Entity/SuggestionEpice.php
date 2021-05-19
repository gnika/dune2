<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuggestionEpice
 *
 * @ORM\Table(name="suggestion_epice")
 * @ORM\Entity
 */
class SuggestionEpice
{
    /**
     * @var int
     *
     * @ORM\Column(name="sug_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sugId;

    /**
     * @var int
     *
     * @ORM\Column(name="sug_id_user", type="integer", nullable=false)
     */
    private $sugIdUser;

    /**
     * @var int
     *
     * @ORM\Column(name="sug_id_faction", type="integer", nullable=false)
     */
    private $sugIdFaction;

    /**
     * @var int
     *
     * @ORM\Column(name="sug_nb_suggestion", type="integer", nullable=false)
     */
    private $sugNbSuggestion;

    public function getSugId(): ?int
    {
        return $this->sugId;
    }

    public function getSugIdUser(): ?int
    {
        return $this->sugIdUser;
    }

    public function setSugIdUser(int $sugIdUser): self
    {
        $this->sugIdUser = $sugIdUser;

        return $this;
    }

    public function getSugIdFaction(): ?int
    {
        return $this->sugIdFaction;
    }

    public function setSugIdFaction(int $sugIdFaction): self
    {
        $this->sugIdFaction = $sugIdFaction;

        return $this;
    }

    public function getSugNbSuggestion(): ?int
    {
        return $this->sugNbSuggestion;
    }

    public function setSugNbSuggestion(int $sugNbSuggestion): self
    {
        $this->sugNbSuggestion = $sugNbSuggestion;

        return $this;
    }


}
