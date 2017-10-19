<?php

namespace kdaviesnz\chemistry;


interface IBond
{

    public function isPolar():bool;
    public function getBondedElement();

}