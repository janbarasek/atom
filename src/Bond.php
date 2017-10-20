<?php
declare(strict_types = 1);

namespace kdaviesnz\atom;


class Bond implements IBond
{

    private $bondedElement = null;
    private $type = "single"; // single/double/triple
    private $angle = 0.00;
    private $parentAtom = null;

    /**
     * Bond constructor.
     * @param null $bondedElement
     * @param string $bondType
     */
    public function __construct(IAtom &$bondedElement, string $type="single", float $angle=0.00)
    {
        $this->bondedElement = $bondedElement;
    }

    /**
     * @return IAtom|null
     */
    public function getBondedElement():IAtom
    {
        return $this->bondedElement;
    }

    public function isPolarCovalent(): bool
    {
        if (!empty($this->parentAtom)) {
            $parentValence = $this->parentAtom->getValence();
            $bondedElementValence = $this->bondedElement->getValence();
            return abs($parentValence - $bondedElementValence) >= 0.5 && abs($parentValence - $bondedElementValence) <= 1.9;
        }
        return false;         ;
    }

    public function isCovalent(): bool
    {
        if (!empty($this->parentAtom)) {
            $parentValence = $this->parentAtom->getValence();
            $bondedElementValence = $this->bondedElement->getValence();
            return abs($parentValence - $bondedElementValence) < 0.5;
        }
        return false;         ;
    }

    public function isIonic(): bool
    {
        if (!empty($this->parentAtom)) {
            $parentValence = $this->parentAtom->getValence();
            $bondedElementValence = $this->bondedElement->getValence();
            return abs($parentValence - $bondedElementValence) > 1.9;
        }
        return false;
    }

    /**
     * @return null
     */
    public function getParentAtom():IAtom
    {
        return $this->parentAtom;
    }

    /**
     * @param null $parentAtom
     */
    public function setParentAtom(IAtom $parentAtom)
    {
        $this->parentAtom = $parentAtom;
    }


}

