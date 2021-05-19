<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuoteRepository;

/**
 * Quote
 *
 * @ORM\Table(name="quote")
 * @ORM\Entity(repositoryClass=QuoteRepository::class)
 */
class Quote
{
    /**
     * @var int
     *
     * @ORM\Column(name="quo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $quoId;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_id_perso", type="integer", nullable=false)
     */
    private $quoIdPerso;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_maj_quete", type="integer", nullable=false)
     */
    private $quoMajQuete;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_maj_quete_perso", type="integer", nullable=false)
     */
    private $quoMajQuetePerso;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_maj_quete_id_ext", type="integer", nullable=false)
     */
    private $quoMajQueteIdExt;

    /**
     * @var string
     *
     * @ORM\Column(name="quo_quote", type="text", length=65535, nullable=false)
     */
    private $quoQuote;

    /**
     * @var string
     *
     * @ORM\Column(name="quo_quote_en", type="text", length=65535, nullable=false)
     */
    private $quoQuoteEn;

    /**
     * @var string
     *
     * @ORM\Column(name="quo_humeur", type="string", length=55, nullable=false)
     */
    private $quoHumeur;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_reponse", type="integer", nullable=false)
     */
    private $quoReponse;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_id_multiple", type="integer", nullable=false)
     */
    private $quoIdMultiple;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_nb_multiple", type="integer", nullable=false)
     */
    private $quoNbMultiple;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_recompense_multi", type="integer", nullable=false)
     */
    private $quoRecompenseMulti;

    /**
     * @var int
     *
     * @ORM\Column(name="quo_recompense_nb_multi", type="integer", nullable=false)
     */
    private $quoRecompenseNbMulti;

    /**
     * @var string
     *
     * @ORM\Column(name="quo_fnctn", type="text", length=65535, nullable=false)
     */
    private $quoFnctn;

    /**
     * @var string
     *
     * @ORM\Column(name="quo_journal", type="string", length=211, nullable=false)
     */
    private $quoJournal;

    public function getQuoId(): ?int
    {
        return $this->quoId;
    }

    public function getQuoIdPerso(): ?int
    {
        return $this->quoIdPerso;
    }

    public function setQuoIdPerso(int $quoIdPerso): self
    {
        $this->quoIdPerso = $quoIdPerso;

        return $this;
    }

    public function getQuoMajQuete(): ?int
    {
        return $this->quoMajQuete;
    }

    public function setQuoMajQuete(int $quoMajQuete): self
    {
        $this->quoMajQuete = $quoMajQuete;

        return $this;
    }

    public function getQuoMajQuetePerso(): ?int
    {
        return $this->quoMajQuetePerso;
    }

    public function setQuoMajQuetePerso(int $quoMajQuetePerso): self
    {
        $this->quoMajQuetePerso = $quoMajQuetePerso;

        return $this;
    }

    public function getQuoMajQueteIdExt(): ?int
    {
        return $this->quoMajQueteIdExt;
    }

    public function setQuoMajQueteIdExt(int $quoMajQueteIdExt): self
    {
        $this->quoMajQueteIdExt = $quoMajQueteIdExt;

        return $this;
    }

    public function getQuoQuote(): ?string
    {
        return $this->quoQuote;
    }

    public function setQuoQuote(string $quoQuote): self
    {
        $this->quoQuote = $quoQuote;

        return $this;
    }

    public function getQuoQuoteEn(): ?string
    {
        return $this->quoQuoteEn;
    }

    public function setQuoQuoteEn(string $quoQuoteEn): self
    {
        $this->quoQuoteEn = $quoQuoteEn;

        return $this;
    }

    public function getQuoHumeur(): ?string
    {
        return $this->quoHumeur;
    }

    public function setQuoHumeur(string $quoHumeur): self
    {
        $this->quoHumeur = $quoHumeur;

        return $this;
    }

    public function getQuoReponse(): ?int
    {
        return $this->quoReponse;
    }

    public function setQuoReponse(int $quoReponse): self
    {
        $this->quoReponse = $quoReponse;

        return $this;
    }

    public function getQuoIdMultiple(): ?int
    {
        return $this->quoIdMultiple;
    }

    public function setQuoIdMultiple(int $quoIdMultiple): self
    {
        $this->quoIdMultiple = $quoIdMultiple;

        return $this;
    }

    public function getQuoNbMultiple(): ?int
    {
        return $this->quoNbMultiple;
    }

    public function setQuoNbMultiple(int $quoNbMultiple): self
    {
        $this->quoNbMultiple = $quoNbMultiple;

        return $this;
    }

    public function getQuoRecompenseMulti(): ?int
    {
        return $this->quoRecompenseMulti;
    }

    public function setQuoRecompenseMulti(int $quoRecompenseMulti): self
    {
        $this->quoRecompenseMulti = $quoRecompenseMulti;

        return $this;
    }

    public function getQuoRecompenseNbMulti(): ?int
    {
        return $this->quoRecompenseNbMulti;
    }

    public function setQuoRecompenseNbMulti(int $quoRecompenseNbMulti): self
    {
        $this->quoRecompenseNbMulti = $quoRecompenseNbMulti;

        return $this;
    }

    public function getQuoFnctn(): ?string
    {
        return $this->quoFnctn;
    }

    public function setQuoFnctn(string $quoFnctn): self
    {
        $this->quoFnctn = $quoFnctn;

        return $this;
    }

    public function getQuoJournal(): ?string
    {
        return $this->quoJournal;
    }

    public function setQuoJournal(string $quoJournal): self
    {
        $this->quoJournal = $quoJournal;

        return $this;
    }


}
