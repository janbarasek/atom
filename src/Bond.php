<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


class Bond implements IBond
{
	public $isRecip;

	/**
	 * single/double/triple
	 *
	 * @var IAtom|null
	 */
	private $bondedElement;

	private $type = "single";

	private $angle = 0.00;

	private $parentAtom;

	private $id;


	/**
	 * @param IAtom $bondedElement
	 * @param string $id
	 * @param string $type
	 * @param float $angle
	 * @param bool $isRecip
	 */
	public function __construct(IAtom &$bondedElement, string $id, string $type = "single", float $angle = 0.00, bool $isRecip = false)
	{
		$this->bondedElement = $bondedElement;
		$this->id = $id;
		$this->type = $type;
		$this->isRecip = $isRecip;
	}


	/**
	 * @return IAtom|null
	 */
	public function getBondedElement(): IAtom
	{
		return $this->bondedElement;
	}


	public function isPolarCovalent(): bool
	{
		if (!empty($this->parentAtom)) {
			$parentValence = $this->parentAtom->getValence();
			$bondedElementValence = $this->bondedElement->getValence();

			return abs($parentValence - $bondedElementValence) >= 0.5 && abs($parentValence - $bondedElementValence) <= 1.9;
		}

		return false;
	}


	public function isCovalent(): bool
	{
		if (!empty($this->parentAtom)) {
			$parentValence = $this->parentAtom->getValence();
			$bondedElementValence = $this->bondedElement->getValence();

			return abs($parentValence - $bondedElementValence) < 0.5;
		}

		return false;
	}


	public function isIonic(): bool
	{
		if (!empty($this->parentAtom)) {
			$parentValence = $this->parentAtom->getValence();
			$bondedElementValence = $this->bondedElement->getValence();

			return abs($parentValence - $bondedElementValence) > 1.9;
		}

		return false;
	}


	/**
	 * @return IAtom
	 */
	public function getParentAtom(): IAtom
	{
		return $this->parentAtom;
	}


	/**
	 * @param IAtom $parentAtom
	 */
	public function setParentAtom(IAtom $parentAtom)
	{
		$this->parentAtom = $parentAtom;
	}


	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}


	/**
	 * @param string $type
	 */
	public function setType(string $type)
	{
		$this->type = $type;
	}
}

