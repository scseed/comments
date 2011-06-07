<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * Template Controller Comments
 *
 * @package SCSeed
 * @package Comments
 * @author Sergei Gladkovskiy <smgladkovskiy@gmail.com>
 */
class Controller_Comment extends Controller_Template {

	/**
	 * Shows comments tree
	 *
	 * @throws HTTP_Exception_404
	 * @return void
	 */
	public function action_tree()
	{
		$allow_comments    = $this->request->param('visibility');
		$object_id         = (int) $this->request->param('object_id');
		$comment_type_name = HTML::chars($this->request->param('type'));

		if($allow_comments == 'hide')
		{
			$this->template->content = NULL;
			exit();
		}

		if( ! $this->_ajax OR ! $object_id)
			throw new HTTP_Exception_404();

		$comment_type = Jelly::query('comment_type')->where('name', '=', $comment_type_name)->limit(1)->select();

		if( ! $comment_type->loaded())
		{
			try
			{
				$comment_type->save();
			}
			catch(Jelly_Validation_Exception $e)
			{
				throw new HTTP_Exception_500('Ошибка при сохранении типа комментария.');
			}
		}

		$comments_root = Jelly::query('comment')
			->where('object_id', '=', $object_id)
			->where('type', '=', $comment_type->id)
			->where('level', '=', 0)
			->limit(1)
			->select();

		$place = 'next';

		if( ! $comments_root->loaded())
		{
			$scope = Jelly::query('comment')->order_by('scope', 'DESC')->limit(1)->select();
			if( ! $scope->loaded())
			{
				$scope = 1;
			}
			else
			{
				$scope = $scope->scope + 1;
			}

			$comments_root = Jelly::factory('comment')
				->set(array(
					'object_id' => $object_id,
					'type' => $comment_type->id,
					'text'      => '-'
				))->save();
			$comments_root->insert_as_new_root($scope);
			$place = 'inside';
		}
		else
		{
			$comments_root_childrens = $comments_root->children(FALSE, 'DESC', 1);
			$last_comment = ($comments_root_childrens->loaded())
				? $comments_root_childrens
				: $comments_root->children(TRUE, 'DESC', 1);

			if($last_comment->id == $comments_root->id)
				$place = 'inside';
		}

		StaticJs::instance()->addJs('/js/comments.js');

		$this->template->content = View::factory('frontend/content/comments/tree')
			->set('comments', $comments_root->render_descendants('comments/list'))
			->bind('last_comment_id', $last_comment->id)
			->bind('object_id', $object_id)
			->bind('place', $place)
			->bind('comment_type', $comment_type->name)
			;
	}

	public function action_add()
	{
		$comment_root_id = (int) $this->request->param('object_id', NULL);
		$comment_place   = HTML::chars($this->request->param('place', 'next'));
		$comment_type    = HTML::chars($this->request->param('type'));
		$language_abbr   = HTML::chars($this->request->param('lang'), I18n::lang());

		if( ! $comment_root_id)
			throw new HTTP_Exception_404();

		if($_POST)
		{
			$post    = Arr::extract($_POST, array('text'));

			if( ! $post['text'])
				$this->request->redirect(Request::initial()->referrer().'#comment_'.$comment_root_id);

			$language = Jelly::query('system_lang')->where('abbr', '=', $language_abbr)->limit(1)->select();

			$comment_type_id = Jelly::query('comment_type')
				->where('name', '=', $comment_type)
				->limit(1)
				->select()
				->id;

			$post['object_id'] = $comment_root_id;
			$post['text']      = trim(HTML::chars($post['text']));
			$post['author']    = $this->_user->id;
			$post['type']      = $comment_type_id;
			$post['lang']      = $language->id;

			$comment = Jelly::factory('comment')
				->set($post);

			if( $comment_place == 'inside')
			{
				$comment->insert_as_last_child((int) $comment_root_id);
			}
			else
			{
				$comment->insert_as_next_sibling((int) $comment_root_id);
			}

			$this->request->redirect(Request::initial()->referrer().'#comment_'.$comment->id);
		}

		$this->template->content = View::factory('frontend/form/blog/comment');

	}
} // End Controller_Comment