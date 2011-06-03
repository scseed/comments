<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Comment Model for Jelly ORM
 *
 * @package SCSeed
 * @package Comments
 * @author Sergei Gladkovskiy <smgladkovskiy@gmail.com>
 */
class Model_Comment extends Jelly_Model_MPTT {

	protected $_directory = 'frontend/content/';

	/**
	 * Initializating model meta information
	 *
	 * @param Jelly_Meta $meta
	 */
	public static function initialize(Jelly_Meta $meta)
	{
		$meta->table('comments')
			->fields(array(
				'id' => Jelly::field('Primary'),

				'type'   => Jelly::field('BelongsTo', array(
					'foreign' => 'comment_type'
				)),
				'author' => Jelly::field('BelongsTo', array(
					'foreign'    => 'user',
					'default'    => NULL,
					'allow_null' => TRUE,
				)),
				'lang' => Jelly::field('BelongsTo', array(
					'foreign' => 'system_lang',
					'model' => 'system_lang'
				)),

				'object_id' => Jelly::field('Integer'),

				'date_create' => Jelly::field('Timestamp', array(
					'auto_now_create' => TRUE,
				)),
				'date_update' => Jelly::field('Timestamp', array(
					'auto_now_update' => TRUE,
					'default'         => NULL,
					'null'            => TRUE,
				)),

				'text' => Jelly::field('Text', array(
					'empty' => FALSE,
					'rules' => array(
						array('not_empty')
					),
				)),

				'is_active' => Jelly::field('Boolean', array(
					'default' => TRUE
				)),
			))
		->load_with(array('type', 'author'));

		parent::initialize($meta);
	}
} // End Model_Comment