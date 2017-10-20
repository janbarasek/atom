<?php
declare(strict_types = 1);

namespace kdaviesnz\atom;


class Bond implements IBond
{

    private $bondedElement = null;
    private $type = "single"; // single/double/triple
    private $angle = 0.00;


    /**
     * Bond constructor.
     * @param null $bondedElement
     * @param string $bondType
     */
    public function __construct(IAtom $bondedElement, string $type="single", float $angle=0.00)
    {
        $this->bondedElement = $bondedElement;
    }

    /**
     * @return IAtom|null
     */
    public function getBondedElement()
    {
        return $this->bondedElement;
    }

    public function isPolar(): bool
    {
        // TODO: Implement isPolar() method.
        return false;
    }

}

