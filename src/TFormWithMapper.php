<?php
namespace Librette\Forms;

use Nette\Application\UI\Presenter;
use Nette\ComponentModel\IComponent;

/**
 * @author David Matejka
 */
trait TFormWithMapper
{

	/** @var array of callbacks invoked before onSuccess callback */
	public $onBeforeSuccess = [];

	/** @var array of callbacks invoked after onSuccess callback */
	public $onAfterSuccess = [];

	/** @var array of callbacks invoked right before mapper loads data */
	public $onLoad = [];

	/** @var array of callbacks invoked right after mapper loads data */
	public $onAfterLoad = [];

	/** @var array of callbacks invoked when form is attached to presenter */
	public $onAttached = [];

	/** @var IMapper */
	protected $mapper;


	public function fireEvents()
	{
		$originalOnSuccess = $this->onSuccess;
		$this->onSuccess = [];
		$this->onSuccess[] = function () use ($originalOnSuccess) {
			$events = [];
			$events[] = $this->onBeforeSuccess;
			$events[] = [function ($form) {
				if ($this->mapper) {
					$this->mapper->save($form);
				}
			}];
			$events[] = $originalOnSuccess;
			$events[] = $this->onAfterSuccess;
			try {
				foreach ($events as $event) {
					if (!is_array($event) && !$event instanceof \Traversable) {
						continue;
					}
					foreach ($event as $handler) {
						if (!$this->isValid()) {
							$this->onError($this);
							$this->abort();
						}
						\Nette\Utils\Callback::invoke($handler, $this);
					}
				}
			} catch (StopExecutionException $e) {

			}
		};
		if ($this->mapper && $this->mapper instanceof IValidationMapper) {
			$this->onValidate[] = [$this->mapper, 'validate'];
		}

		parent::fireEvents();
		$this->onSuccess = $originalOnSuccess;
	}


	/**
	 * aborts execution of on*Success callbacks
	 *
	 * @throws StopExecutionException
	 */
	public function abort()
	{
		throw new StopExecutionException;
	}


	/**
	 * @return IMapper
	 */
	public function getMapper()
	{
		return $this->mapper;
	}


	/**
	 * @param IMapper $mapper
	 */
	public function setMapper(IMapper $mapper)
	{
		$this->mapper = $mapper;
	}


	/**
	 * @param IComponent|Presenter $presenter
	 */
	protected function attached($presenter)
	{
		if ($presenter instanceof Presenter) {
			parent::attached($presenter);
			if (!$this->isSubmitted()) {
				$this->onLoad($this);
				if ($this->getMapper()) {
					$this->getMapper()->load($this);
				}
				$this->onAfterLoad($this);
			}
			$this->onAttached($this);
		} else {
			parent::attached($presenter);
		}
	}

}
