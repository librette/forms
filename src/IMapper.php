<?php
namespace Librette\Forms;

use Nette;

/**
 * @author David Matějka
 */
interface IMapper
{

	/**
	 * loads values to form
	 *
	 * @param Form $form
	 * @return void
	 */
	function load(Nette\Forms\Form $form);


	/**
	 * save values from form
	 *
	 * @param Form $form
	 * @return void
	 */
	function save(Nette\Forms\Form $form);
}