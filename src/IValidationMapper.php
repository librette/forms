<?php
namespace Librette\Forms;

use Nette\Forms\Form;

/**
 * @author David Matejka
 */
interface IValidationMapper extends IMapper
{

	/**
	 * @param Form $form
	 * @return void
	 */
	public function validate(Form $form);
}