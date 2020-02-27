<?php
namespace Librette\Forms;

use Nette;
use Nette\Forms\IFormRenderer;
use Nette\Localization\ITranslator;

/**
 * @author David Matejka
 */
class FormFactory implements IFormFactory
{
	use Nette\SmartObject;

	/** @var IFormRenderer */
	protected $renderer;

	/** @var ITranslator */
	protected $translator;


	/**
	 * @param IFormRenderer $renderer
	 * @param ITranslator $translator
	 */
	function __construct(IFormRenderer $renderer = NULL, ITranslator $translator = NULL)
	{
		$this->renderer = $renderer;
		$this->translator = $translator;
	}


	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form();
		if ($this->translator) {
			$form->setTranslator($this->translator);
		}
		if ($this->renderer) {
			$form->setRenderer($this->renderer);
		}

		return $form;
	}
}
