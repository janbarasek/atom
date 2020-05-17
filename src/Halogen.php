<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


/**
 * The five nonmetallic chemical elements that make up the halogen family are fluorine (the symbol for which is F),
 * chlorine (Cl), bromine (Br), iodine (I), and astatine (At).
 * The halogens are in Group VIIa of the periodic table (see Periodic Table).
 */
class Halogen extends AtomicElementDecorator implements IHalogen
{
	public function __construct(AtomicElementComponent $atom)
	{
		if (!in_array($atom->chem, ["F", "Cl", "Br", "I", "At", "X"])) {
			throw new \Exception("Halogen object: Not a halogen - " . $atom->chem);
		}
		$this->atomicElement = $atom;
	}
}