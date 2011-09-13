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
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/stepper/core.php
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
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/stepper/core.php
 */
abstract class Stepper_Core
{
  protected $_alias     = '';                /** Alias of this stepper */
  protected $_steps     = array();           /** Steps */
  protected $_view_name = 'stepper/default'; /** Name of the view to render */


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
   * Set the lastdone step
   *
   * Chainable method.
   *
   * @param int $lastdone_step_nb Number of the lastdone step
   *
   * @return this
   */
  protected function _lastdone($lastdone_step_nb)
  {
    $step_nb = 1;

    foreach ($this->_steps as $step)
    {
      if ($step_nb == $lastdone_step_nb)
      {
        $step->lastdone(TRUE);
      }
      else
      {
        $step->lastdone(FALSE);
      }

      $step_nb++;
    }

    return $this;
  }


  /**
   * Makes final adjustments before rendering
   *
   * @return null
   */
  protected function _pre_render()
  {
    // Mark last step with last flag
    foreach($this->_steps as $step)
    {
      $step->last(FALSE);
    }
    $this->_steps[sizeof($this->_steps)-1]->last(TRUE);
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
   * @param Stepper_Step $step Instance of a step
   *
   * @return this
   */
  public function add_step(Stepper_Step $step)
  {
    $this->_steps[] = $step;

    return $this;
  }


  /**
   * Set the current step
   *
   * Chainable method.
   *
   * @param int $current_step_nb Number of the current step
   *
   * @return this
   */
  public function current($current_step_nb)
  {
    $step_nb = 1;

    foreach ($this->_steps as $step)
    {
      if ($step_nb == $current_step_nb)
      {
        $step->current(TRUE);
        $this->_lastdone($step_nb-1);
        for ($step_nb2 = 0; $step_nb2 < $step_nb-2; $step_nb2++)
        {
          $this->_steps[$step_nb2]->done(TRUE);
        }
      }
      else
      {
        $step->current(FALSE);
      }

      $step_nb++;
    }

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
    $this->_pre_render();

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