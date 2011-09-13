<?php
/**
 * Declares Stepper_Core_Step
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
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/stepper/core/step.php
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Stepper_Core_Step
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
 * @link      https://github.com/emtou/kohana-stepper/tree/master/classes/stepper/core/step.php
 */
abstract class Stepper_Core_Step
{
  protected $_description = '';                       /** Description of the step */
  protected $_is_current  = FALSE;                    /** Is this step the current one */
  protected $_is_done     = FALSE;                    /** Has this step been done */
  protected $_is_last     = FALSE;                    /** Is this step the last one */
  protected $_is_lastdone = FALSE;                    /** Is this step the last done one */
  protected $_label       = '';                       /** Label of the step */
  protected $_url         = '';                       /** URL of the step link */
  protected $_view_name   = 'stepper/step/default';   /** Name of the view to render */


  /**
   * Creates and initialises the step
   *
   * Can't be called, the factory() method must be used.
   *
   * @return null
   */
  protected function __construct()
  {
  }

  /**
   * Create an instance of the Step
   *
   * @return Listo
   */
  public static function factory()
  {
    return new Stepper_Step;
  }


  /**
   * Set the current flag
   *
   * Chainable method.
   *
   * @param bool $is_current Is this step the current one ?
   *
   * @return this
   */
  public function current($is_current = FALSE)
  {
    $this->_is_current = $is_current;

    return $this;
  }


  /**
   * Set the description of the step
   *
   * Chainable method.
   *
   * @param string $description Description of the step
   *
   * @return this
   */
  public function description($description = FALSE)
  {
    $this->_description = $description;

    return $this;
  }


  /**
   * Set the done flag
   *
   * Chainable method.
   *
   * @param bool $is_done Is this step has been done ?
   *
   * @return this
   */
  public function done($is_done = FALSE)
  {
    $this->_is_done = $is_done;

    return $this;
  }


  /**
   * Set the label
   *
   * Chainable method.
   *
   * @param string $label Label of the step
   *
   * @return this
   */
  public function label($label)
  {
    $this->_label = $label;

    return $this;
  }


  /**
   * Set the last flag
   *
   * Chainable method.
   *
   * @param bool $is_last Is this step the last one ?
   *
   * @return this
   */
  public function last($is_last = FALSE)
  {
    $this->_is_last = $is_last;

    return $this;
  }


  /**
   * Set the lastdone flag
   *
   * Chainable method.
   *
   * @param bool $is_lastdone Is this step the last done one ?
   *
   * @return this
   */
  public function lastdone($is_lastdone = FALSE)
  {
    $this->_is_lastdone = $is_lastdone;

    return $this;
  }


  /**
   * Renders the step
   *
   * @param bool $echo Should the output be echoed
   *
   * @return rendered stepper in HTML
   */
  public function render($echo = FALSE)
  {
    $view = View::factory($this->_view_name);

    $view->set('current',     $this->_is_current);
    $view->set('description', $this->_description);
    $view->set('done',        $this->_is_done);
    $view->set('label',       $this->_label);
    $view->set('last',        $this->_is_last);
    $view->set('lastdone',    $this->_is_lastdone);
    $view->set('url',         $this->_url);

    $html = $view->render();

    if ($echo)
    {
      echo $html;
    }

    return $html;
  }


  /**
   * Set the URL of the link
   *
   * Chainable method.
   *
   * @param string $url URL of the step link
   *
   * @return this
   */
  public function url($url = FALSE)
  {
    $this->_url = $url;

    return $this;
  }

}