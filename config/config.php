<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


$GLOBALS['TL_HOOKS']['generatePage'][] = array('ClassCanonical', 'createCanonical');
