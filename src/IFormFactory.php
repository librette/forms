<?php
namespace Librette\Forms;

/**
 * @author David Matejka
 */
interface IFormFactory
{

	/**
	 * @return \Nette\Application\UI\Form
	 */
	public function create();
}