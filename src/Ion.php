<?php
declare(strict_types=1); // must be first line

namespace kdaviesnz\atom;


class Ion extends Atom implements IIon
{

    /**
     * Ion constructor.
     */
    public function __construct(string $chem)
    {
        parent::__construct($chem);
        $this->valence--;
    }
}