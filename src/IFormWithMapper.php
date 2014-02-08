<?php
namespace Librette\Forms;

/**
 * @author David Matejka
 */
interface IFormWithMapper
{

	/**
	 * @param IMapper $mapper
	 * @return void
	 */
	public function setMapper(IMapper $mapper);
}