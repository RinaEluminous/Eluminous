<?php
/**
 * @package        solo
 * @copyright      Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Pagination\Pagination;
use Awf\Pagination\PaginationObject;
use Awf\Text\Text;

/**
 * Method to create an active pagination link to the item
 *
 * @param   PaginationObject $item The object with which to make an active link.
 *
 * @return  string  HTML link
 */
function _akeeba_pagination_item_active(PaginationObject $item)
{
	return '<a href="' . $item->link . '">' . $item->text . '</a>';
}

/**
 * Method to create an inactive pagination string
 *
 * @param   PaginationObject $item The item to be processed
 *
 * @return  string
 */
function _akeeba_pagination_item_inactive(PaginationObject $item)
{
	return '<span>' . $item->text . '</span>';
}

/**
 * Create the html for a list footer
 *
 * @param   array $list Pagination list data structure.
 *
 * @return  string  HTML for a list start, previous, next,end
 */
function _akeeba_pagination_list_render($list, Pagination $pagination)
{
	// Reverse output rendering for right-to-left display.
	$html = '<ul class="pagination">';

	if ($pagination->pagesStart > 1)
	{
		$class = $list['start']['active'] ? '' : ' class="disabled"';
		$html  .= '<li' . $class . '>' . _akeeba_pagination_preprocess_arrows($list['start']['data']) . '</li>';
	}

	$class = $list['previous']['active'] ? '' : ' class="disabled"';
	$html  .= '<li' . $class . '>' . _akeeba_pagination_preprocess_arrows($list['previous']['data']) . '</li>';

	foreach ($list['pages'] as $page)
	{
		$class = $page['active'] ? ($page['current'] ? 'active' : '') : 'disabled';
		$class = empty($class) ? '' : ' class="' . $class . '"';
		$html  .= '<li' . $class . '>' . $page['data'] . '</li>';
	}

	$class = $list['next']['active'] ? '' : ' class="disabled"';
	$html  .= '<li' . $class . '>' . _akeeba_pagination_preprocess_arrows($list['next']['data']) . '</li>';

	if ($pagination->pagesStop < $pagination->pagesTotal)
	{
		$class = $list['end']['active'] ? '' : ' class="disabled"';
		$html  .= '<li' . $class . '>' . _akeeba_pagination_preprocess_arrows($list['end']['data']) . '</li>';
	}

	$html .= '</ul>';

	return $html;
}

/**
 * Replace arrows with icons
 *
 * AWF generates pagination arrows using double and single, left and right angled quotes. In FEF-based software we
 * prefer using elements from our icon font to render a more polished GUI.
 *
 * @param  string $text The source text with the angled quotes
 *
 * @return string The text after the replacements have run
 */
function _akeeba_pagination_preprocess_arrows($text)
{
	$replacements = array(
		'&laquo;'  => '<span class="akion-ios-arrow-back"></span><span class="akion-ios-arrow-back"></span>',
		'&lsaquo;' => '<span class="akion-ios-arrow-back"></span>',
		'&raquo;'  => '<span class="akion-ios-arrow-forward"></span><span class="akion-ios-arrow-forward"></span>',
		'&rsaquo;' => '<span class="akion-ios-arrow-forward"></span>',
	);

	return str_replace(array_keys($replacements), array_values($replacements), $text);
}

/**
 * Create the HTML for a list footer
 *
 * @param   array $list Pagination list data structure.
 *
 * @return  string  HTML for a list footer
 */
function _akeeba_pagination_list_footer($list)
{
	$html = "<div class=\"akeeba-pagination-container\">\n";

	$html .= "\n<div class=\"limit\">" . Text::_('AWF_COMMON_LBL_DISPLAY_NUM') . $list['limitfield'] . "</div>";
	$html .= $list['pageslinks'];
	$html .= "\n<div class=\"counter\">" . $list['pagescounter'] . "</div>";

	$html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"" . $list['limitstart'] . "\" />";
	$html .= "\n</div>";

	return $html;
}
