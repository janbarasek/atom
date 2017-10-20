<?php

namespace kdaviesnz\atom;


interface IBond
{

    public function isPolar():bool;
    public function getBondedElement():IAtom;
    public function isIonic():bool;
    public function setParentAtom(IAtom $parentAtom);
    public function getParentAtom():IAtom;
}