<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


class Ion extends AtomicElementDecorator implements IIon
{
	public function __construct(string $chem)
	{
		$this->atomicElement = new Atom($chem);
		$this->atomicElement->decrementValence();
	}
}