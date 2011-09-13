<?php
/**
 * Declares default Step view
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
 * @link      https://github.com/emtou/kohana-stepper/tree/master/views/stepper/step/default.php
 */

defined('SYSPATH') OR die('No direct access allowed.');

echo '<li';
$classes = array();
if ($done)
{
  $classes[] = 'done';
}
if ($current)
{
  $classes[] = 'current';
}
if ($last)
{
  $classes[] = 'last';
}
if ($lastdone)
{
  $classes[] = 'lastdone';
}
if (sizeof($classes) > 0)
{
  echo ' class="'.implode(' ', $classes).'"';
}
echo '>';
echo '<a href="'.$url.'" title="'.$label.'">';
echo '<em>'.$label.'</em>';
echo '<span>'.$description.'</span>';
echo '</a>';
echo '</li>';