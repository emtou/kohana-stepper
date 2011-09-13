<?php
/**
 * Declares Stepper helper
 *
 * PHP version 5
 *
 * @group stepper
 *
 * @category  Stepper
 * @package   Stepper
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/core/stepper.php
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Stepper helper
 *
 * PHP version 5
 *
 * @group stepper
 *
 * @category  Stepper
 * @package   Stepper
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/core/stepper.php
 */
abstract class Core_Stepper
{
  protected $_alias        = '';                /** Alias of this stepper */
  protected $_current_step = '';                /** Number of the current step */
  protected $_steps        = array();           /** Steps */
  protected $_view_name    = 'stepper/default'; /** Name of the view to render */

  /**
   * Creates and initialises the stepper
   *
   * Can't be called, the factory() method must be used.
   *
   * @param string $alias Alias of this stepper
   *
   * @return null
   */
  protected function __construct($alias)
  {
    $this->_alias = $alias;
  }

  /**
   * Create an instance of the Stepper helper
   *
   * @param string $alias Alias of this stepper
   *
   * @return Listo
   */
  public static function factory($alias)
  {
    return new Stepper($alias);
  }


  /**
   * Define a new step
   *
   * Chainable method.
   *
   * @param array $step_params Parameters of the step
   *
   * @return this
   */
  public function add_step(array $step_params)
  {
    $this->_steps[] = $step_params;

    return $this;
  }


  /**
   * Set the current step
   *
   * Chainable method.
   *
   * @param int $step_nb Number of the current step
   *
   * @return this
   */
  public function current($step_nb)
  {
    $this->_current_step = $step_nb;

    return $this;
  }


  /**
   * Renders the stepper
   *
   * @param bool $echo Should the output be echoed
   *
   * @return rendered stepper in HTML
   */
  public function render($echo = FALSE)
  {
    $view = View::factory($this->_view_name);

    $view->set('steps',  $this->_steps);

    $html = $view->render();

    if ($echo)
    {
      echo $html;
    }

    return $html;
  }

}