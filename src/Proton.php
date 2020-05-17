<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


class Proton extends Ion implements IProton
{
	public function __construct()
	{
		parent::__construct('H');
	}
}