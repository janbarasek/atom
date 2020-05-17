<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


interface IAtom
{
	public function getFormalCharge(): string;

	public function getAtomicNumber(): int;

	public function getGroup(): int;

	public function getValence(): int;

	public function getElectronConfiguration(): string;

	public function createBond(IAtom $bondedElement): bool;

	/**
	 * @return mixed[]
	 */
	public function getBonds(): array;

	public function symbol(): string;

	public function getElectronegativity(): float;

	public function setValence($valence);

	public function setCharge($charge);

	/**
	 * Note than when bond is added valence will change.
	 * @param IBond $bond
	 */
	public function addBond(IBond $bond);

	public function isPrimary(): bool;

	public function isElectrophile(): bool;

	public function isCation(): bool;

	public function isAnion(): bool;

	public function removeBond(IBond $bond): bool;

	public function incrementValence();

	public function decrementValence();
}