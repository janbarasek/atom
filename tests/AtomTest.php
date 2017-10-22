<?php
require_once("src/IAtomicElement.php");
require_once("src/AtomicElementComponent.php");
require_once("src/AtomicElementDecorator.php");
require_once("src/AtomicElement.php");
require_once("src/IBond.php");
require_once("src/Bond.php");
require_once("src/IAtom.php");
require_once("src/Atom.php");
require_once("src/IHalogen.php");
require_once("src/Halogen.php");

class AtomTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }

    public function testAtom()
    {
        $H1 = new \kdaviesnz\atom\Atom("H");
        $H2 = new \kdaviesnz\atom\Atom("H");
        $O = new \kdaviesnz\atom\Atom("O");

        $ion = new \kdaviesnz\atom\Halogen(new \kdaviesnz\atom\Atom("Cl"));

        // Bonds
        $H1->addBond(
            new \kdaviesnz\atom\Bond($O, "bond1")
        );
        $H2->addBond(
            new \kdaviesnz\atom\Bond($O, "bond1")
        );
        $O->addBond(
            new \kdaviesnz\atom\Bond($H1, "bond2")
        );
        $O->addBond(
            new \kdaviesnz\atom\Bond($H2, "bond2")
        );

    }

}
