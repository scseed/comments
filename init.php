<?php defined('SYSPATH') or die('No direct script access.');

$langs = Page::instance()->system_langs();

Route::set('comments', '(<lang>/)comment(/<action>(/<type>)(/<object_id>(/<place>)(/<visibility>)))', array(
	'lang'       => $langs,
	'type'       => '\w+',
	'object_id'  => '[-_\w]+',
	'place'      => '(inside|next)',
	'visibility' => '(show|hide)'
))
	->defaults(array(
		'controller' => 'comment',
		'action'     => 'tree',
		'visibility' => 'show',
		'lang'       => I18n::lang(),
));