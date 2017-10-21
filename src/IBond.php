<?php

namespace kdaviesnz\atom;


interface IBond
{

    public function isCovalent():bool;
    public function isPolarCovalent():bool;
    public function getBondedElement():IAtom;
    public function isIonic():bool;
    public function setParentAtom(IAtom $parentAtom);
    public function getParentAtom():IAtom;
    public function getId(): string;
}