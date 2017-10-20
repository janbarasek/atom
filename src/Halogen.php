<?php
declare(strict_types=1); // must be first line

namespace kdaviesnz\atom;

class Halogen extends Atom implements IHalogen
{

    /**
     * Halogen constructor.
     */
    public function __construct(string $chem)
    {
        /*
         The five nonmetallic chemical elements that make up the halogen family are fluorine (the symbol for which is F), chlorine (Cl), bromine (Br), iodine (I), and astatine (At). The halogens are in Group VIIa of the periodic table (see Periodic Table).
         */
        if (in_array($chem, array("F", "Cl", "Br", "I", "At", "X"))) {
            throw new Exception("Not a halogen");
        }
        parent::__construct($chem);
    }
}