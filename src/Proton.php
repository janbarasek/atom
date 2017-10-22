<?php
declare(strict_types=1); // must be first line

namespace kdaviesnz\atom;

class Proton extends Ion implements IProton
{


    /**
     * Proton constructor.
     */
    public function __construct()
    {
        parent::__construct("H");

    }
}