<?php
namespace Librette\Forms;

use Nette\Forms\Form as NForm;

/**
 * @author David Matejka
 */
interface IValidationMapper extends IMapper
{

	/**
	 * @param NForm $form
	 * @return void
	 */
	public function validate(NForm $form);
}
