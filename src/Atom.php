<?php

declare(strict_types=1);

namespace kdaviesnz\atom;


class Atom extends AtomicElementComponent implements IAtom
{
	public $chem = "";

	protected $valence = 0;

	private $chemicalMap = [];

	private $atomic_number = 0;

	private $group = 0;

	private $base_valence = 0;

	private $electron_configuration = "";

	private $bonds = [];

	private $symbol = "";

	private $electronegativity = 0.00;

	private $charge = "neutral";


	/**
	 * @param array $chem
	 * @see https://en.wikipedia.org/wiki/Periodic_table#/media/File:Periodic_Table_Chart.png
	 * @see https://chem.libretexts.org/Core/Inorganic_Chemistry/Descriptive_Chemistry/Elements_Organized_by_Block/2_p-Block_Elements/Group_15%3A_The_Nitrogen_Family/Z%3D007_Chemistry_of_Nitrogen_(Z%3D7)
	 * @see http://periodictable.com/Properties/A/Valence.al.html
	 * @see http://www.tutor-homework.com/Chemistry_Help/electronegativity_table/electronegativity.html
	 */
	public function __construct(string $chem)
	{
		$this->chem = $chem;

		// Strip out numbers to the left and right.
		$chem = preg_replace('/[0-9]*$/', '', $chem);
		$chem = preg_replace('/^[0-9]+/', '', $chem);

		$this->chemicalMap = [
			"H" => [
				"atomic number" => 1,
				"group" => 1,
				"valence" => 1,
				"base valence" => 1,
				"electron configuration" => "",
				"electronnegativity" => 2.1,
			],
			"He" => [
				"atomic number" => 2,
				"group" => 18,
				"valence" => 0,
				"base valence" => 0,
				"electron configuration" => "",
				"electronnegativity" => 0,
			],
			"Be" => [
				"atomic number" => 4,
				"group" => 2,
				"base valence" => 0,
				"electron configuration" => "",
				"electronnegativity" => 1.57,
			],
			"C" => [
				"atomic number" => 6,
				"group" => 14,
				"valence" => 4,
				"base valence" => 4,
				"electron configuration" => "",
				"electronnegativity" => 2.55,
			],
			"N" => [
				"atomic number" => 7,
				"group" => 15,
				"valence" => 5,
				"base valence" => 5,
				"electron configuration" => "",
				"electronnegativity" => 3.04,
			],
			"O" => [
				"atomic number" => 8,
				"group" => 16,
				"valence" => 2,
				"base valence" => 2,
				"electron configuration" => "",
				"electronnegativity" => 3.44,
			],
			"F" => [
				"atomic number" => 9,
				"group" => 17,
				"valence" => 1,
				"base valence" => 1,
				"electron configuration" => "",
				"electronnegativity" => 3.44,
			],
			"Ne" => [
				"atomic number" => 10,
				"group" => 18,
				"electron configuration" => "",
				"electronnegativity" => 0,
				"base valence" => 0,
			],
			"I" => [
				"atomic number" => 153,
				"group" => 17,
				"valence" => 7,
				"base valence" => 7,
				"electron configuration" => "",
				"electronnegativity" => 2.66,
			],
			"Na" => [
				"atomic number" => 11,
				"group" => 1,
				"valence" => 1,
				"base valence" => 1,
				"electron configuration" => "",
				"electronnegativity" => 0.93,
			],
			"Cl" => [
				"atomic number" => 17,
				"group" => 17,
				"valence" => 7,
				"base valence" => 7,
				"electron configuration" => "",
				"electronnegativity" => 3.16,
			],
			"Br" => [
				"atomic number" => 35,
				"group" => 17,
				"valence" => 7,
				"base valence" => 7,
				"electron configuration" => "1s22s22p63s23p64s23d104p5",
				"electronnegativity" => 2.96,
			],


		];

		$item = $this->chemicalMap[$chem];
		$this->electron_configuration = $item["electron configuration"];
		$this->atomic_number = $item["atomic number"];
		$this->group = $item["group"];
		$this->valence = $item["valence"];
		$this->base_valence = $item["base valence"];
		$this->symbol = $chem;
		$this->electronegativity = $item["electronnegativity"];
	}


	/**
	 * @return array
	 */
	public function getBonds(): array
	{
		return $this->bonds;
	}


	/**
	 * @return string
	 */
	public function symbol(): string
	{
		return $this->symbol;
	}


	/**
	 * @return int
	 */
	public function getAtomicNumber(): integer
	{
		return $this->atomic_number;
	}


	/**
	 * @return int
	 */
	public function getGroup(): int
	{
		return $this->group;
	}


	/**
	 * @return int
	 */
	public function getValence(): int
	{
		return $this->valence;
	}


	/**
	 * @param int $valence
	 */
	public function setValence($valence)
	{
		$this->valence = $valence;
	}


	/**
	 * @return string
	 */
	public function getElectronConfiguration(): string
	{
		if (empty($this->electron_configuration)) {

			// Atoms must have equal numbers of protons and electrons.
			// The atomic number is the number of protons.
			// Hence the number of electrons is equal to the atomic number.

			$numberOfElectronsLeft = $this->atomic_number;
			$electron_configuration = [];
			$shell = 1;
			$orbitalsMap = [
				["s"],
				["s", "px", "py", "pz"],
				["s", "px", "py", "pz", "d", "d", "d", "d", "d"],
			];

			// Process each shell until we run out of electrons.
			do {
				// Each shell can contain up to 2n2 electrons
				$maxNumberOfElectronsInCurrentShell = 2 * $shell ^ 2;
				$orbitals = $orbitalsMap[$shell - 1];
				if ($numberOfElectronsLeft - $maxNumberOfElectronsInCurrentShell > 0) {
					foreach ($orbitals as $orbital) {
						$electron_configuration[] = $shell . $orbital . "2";
					}
				} else {
					$temp = [];
					$orbitalIndex = 0;
					for ($i = 0; $i < $numberOfElectronsLeft; $i++) {
						if (!isset($temp[$orbitalIndex])) {
							$temp[$orbitalIndex] = $shell . $orbitals[$orbitalIndex] . "1";
						} else {
							$temp[$orbitalIndex] = $shell . $orbitals[$orbitalIndex] . "2";
						}
						$orbitalIndex++;
						if (!isset($orbitals)) {
							$orbitalIndex = 0;
						}
					}
					$electron_configuration = array_merge($electron_configuration, $temp);
				}
				$numberOfElectrons = $numberOfElectronsLeft - $maxNumberOfElectronsInCurrentShell;
			} while ($shell < 4 && $numberOfElectronsLeft > 0);

			$this->electron_configuration = implode("", $electron_configuration);


		}

		return $this->electron_configuration;
	}


	/**
	 * @param IAtom $bondedElement
	 * @return bool
	 */
	public function createBond(IAtom $bondedElement): bool
	{
		$bondType = "";

		// Get the bond type using the valence of $this and $bondedElement
		if ($this->symbol() == "C" || $bondedElement->symbol() == "C") {
			$bondType = "covalent";
		} else {
			/*
			 * Here are the general rules for determining whether a bond will be covalent or ionic:
				If there is no difference in the electronegativities of the two atoms, the bond will be purely covalent.
				If the electronegativity difference between the two atoms is between 0 and 2, the bond will be polar covalent.
				If the electronegativity difference between the two atoms is greater than 2, the bond will be ionic.
			 */
			if ($this->electronegativity == $bondedElement->getElectronegativity()) {
				$bondType = "covalent";
			} elseif (abs($this->electronegativity - $bondedElement->getElectronegativity()) > 2) {
				$bondType = "ionic";
				if ($this->electronegativity > $bondedElement->getElectronegativity()) {
					$this->electronegativity->status = "negative";
					$bondedElement->setCharge("positive");
				} else {
					$this->electronegativity->status = "positive";
					$bondedElement->setCharge("negative");
				}
			} else {
				$bondType = "polar covalent";

				/*
				 “In a polar covalent bond, the electrons in the bond are not equally shared between the two atoms. Instead, the more electronegative atom bullies most of the bonding electrons away from the less electronegative atom, creating a separation of charge in the bond. This separation is called a dipole moment. Dipole moments are often used to explain how molecules react, so learning how to predict the dipole moment of any bond, or of a molecule, is a very important skill to add to your toolbox.”

				“If you want to draw the dipole vector for a bond, you need to look at the electronegativities of the two atoms. The atom with the higher electronegativity becomes partially negative, because this atom is the greater electron hog, and the atom with the lower electronegativity becomes partially positive. You then draw the dipole vector with the head pointing toward the more electronegative atom and the tail pointing toward the partially positive atom. The size of the vector depends on the difference in electronegativity; draw a long vector for large differences in electronegativity, and a short vector for smaller differences.”
				 */
				if ($this->electronegativity > $bondedElement->getElectronegativity()) {
					$this->electronegativity->status = "partially negative";
					$bondedElement->setCharge("partially positive");
				} else {
					$this->electronegativity->status = "partially positive";
					$bondedElement->setCharge("partially negative");
				}
			}

		}

		// Check that a bond can be created.
		if ($this->valence != 0 && !empty($bondType)) {
			// Create Bond object and add it the list of bonds.
			$this->bonds[] = new Bond($bondedElement, $bondType);
			// Reduce valence by 1 as we have a bond.
			$this->valence--;
			$bondedElement->setValence($bondedElement->getValence() - 1);

			return true;
		} else {
			return false;
		}
	}


	/**
	 * @return float
	 */
	public function getElectronegativity(): float
	{
		return $this->electronegativity;
	}


	/**
	 * @param string $charge
	 */
	public function setCharge($charge)
	{
		$this->charge = $charge;
	}


	public function addBond(IBond $bond)
	{

		$bond->setParentAtom($this);
		$bondedAtomValence = $bond->getBondedElement()->getValence();
		if ($bond->isIonic()) {
			$bondedAtomValence > $this->valence ? $this->valence-- : $this->valence++;
		}
		$this->bonds[] = $bond;

	}


	public function isCation(): bool
	{
		return $this->valence > $this->base_valence;
	}


	public function isAnion(): bool
	{
		return $this->valence < $this->base_valence;
	}


	public function removeBond(IBond $bond): bool
	{
		$this->bonds = array_values(array_filter(
			$this->bonds,
			function ($item) use ($bond) {
				return $item->getId() != $bond->getId();
			}
		));

		return true;
	}


	public function incrementValence()
	{
		$this->valence++;
	}


	public function decrementValence()
	{
		$this->valence--;
	}


	public function isPrimary(): bool
	{
		// TODO: Implement isPrimary() method.
		return false;
	}


	public function getFormalCharge(): string
	{
		// TODO: Implement getFormalCharge() method.
		return "";
	}


	public function isElectrophile(): bool
	{
		// TODO: Implement isElectrophile() method.
		return false;
	}
}
