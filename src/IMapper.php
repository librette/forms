<?php
namespace Librette\Forms;

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
	function load(Form $form);


	/**
	 * save values from form
	 *
	 * @param Form $form
	 * @return void
	 */
	function save(Form $form);
}