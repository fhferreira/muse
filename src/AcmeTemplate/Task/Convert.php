<?php
/**
 * Part of code-generator project. 
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace AcmeTemplate\Task;

use AcmeTemplate\Action;
use Muse\Controller\AbstractTaskController;
use Windwalker\String\String;

/**
 * Class AcmeController
 *
 * @since 1.0
 */
class Convert extends AbstractTaskController
{
	/**
	 * Execute the controller.
	 *
	 * @return  boolean  True if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 *
	 * @since   1.0
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		// Flip src & dest
		$dest = $this->config['path.src'];
		$src  = $this->config['path.dest'];

		$this->config['path.src']  = $src;
		$this->config['path.dest'] = $dest;

		// Flip replace array
		$this->replace = array_flip($this->replace);

		// Quote by tag variable
		foreach ($this->replace as &$replace)
		{
			$replace = String::quote($replace, (array) $this->config['tag.variable']);
		}

		$this->doAction(new Action\ConvertAction);
	}
}
