<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


class ClassRelCanonical extends Frontend
{
	public function createRelCanonical(Database_Result $objPage, Database_Result $objLayout, PageRegular $objPageRegular)
	{
		if($objPage->canonicalType == 'internal')
		{
			$this->setRelCanonical($this->generateLink($objPage), $objPage->outputFormat);
		}
		
		if($objPage->canonicalType == 'external')
		{
			$this->setRelCanonical($objPage->canonicalWebsite, $objPage->outputFormat);
		}
	}
	
	
	private function generateLink($objPage)
	{
		$strDomain = $this->Environment->base;

		$objCanonicalPage = $this->getPageDetails($objPage->canonicalJumpTo);

		if ($objCanonicalPage->numRows)
		{
			if ($objCanonicalPage->domain != '')
			{
				$strDomain = ($this->Environment->ssl ? 'https://' : 'http://') . $objCanonicalPage->domain . TL_PATH . '/';
			}
		
			$strUrl = $strDomain . $this->generateFrontendUrl($objCanonicalPage->row(), null, $objCanonicalPage->language);
		}
		
		return $strUrl;
	}
	
	
	private function setRelCanonical($canonicalUrl, $outputFormat)
	{
		$xhtmlOutput = '';
			
		if($outputFormat == 'xhtml')
		{
			$xhtmlOutput = ' /';
		}
			
		$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="' . $canonicalUrl . '"'.$xhtmlOutput.'>';
	}
}

?>