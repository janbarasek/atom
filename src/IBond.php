<?php

namespace kdaviesnz\atom;


interface IBond
{

    public function isPolar():bool;
    public function getBondedElement();

}