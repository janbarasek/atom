<?php

namespace kdaviesnz\atom;


interface IAtom
{

    public function getFormalCharge():string;

    /**
     * @return int
     */
    public function getAtomicNumber():integer;
    /**
     * @return int
     */
    public function getGroup():int;

    /**
     * @return int
     */
    public function getValence():integer;

    /**
     * @return int
     */
    public function getElectronConfiguration():string;

    /**
     * @param IAtom $bondedElement
     * @return bool
     */
    public function createBond(IAtom $bondedElement):bool;

    public function getBonds():array;

    /**
     * @return string
     */
    public function symbol():string;

    public function getElectronegativity():float;

    public function setValence($valence);

    public function setCharge($charge);

    /*
     * Note than when bond is added valence will change.
     */
    public function addBond(IBond $bond);

    public function isPrimary():bool;

    public function isElectrophile():bool;

}