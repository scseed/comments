<?php defined('SYSPATH') or die('No direct access allowed.');?>
<ul>
<?php
$level = $nodes->current()->{$level_column};
$first = TRUE;

foreach ($nodes as $node):?>
	<?php
	$author_name = ($node->author->nickname) ? $node->author->nickname : $node->author->fullname;
	$avatar_src  = 'media/images/avatars/'.$node->author->id.'/thumb.jpg';
	$avatar      = ($node->author->has_avatar AND file_exists(DOCROOT.$avatar_src))
		? $avatar_src
		: 'i/stubs/avatar_comment.png';

	if ($node->{$level_column} > $level):?>
		<ul>
	<?php elseif ($node->{$level_column} < $level):?>
		</ul>
		</li>
	<?php elseif ( ! $first):?>
		</li>
	<?php endif;?>
	<li<?php echo ($node->lang->abbr != I18n::lang() ? ' class="another_lang"' : NULL)?>><a name="comment_<?php echo $node->id?>"></a>
		<?php if( ! $node->is_active): ?>
		<h2><?php echo __('Comment is deleted')?></h2>
		<?php else:?>
		<div class="comment">
			<div class="info_wrapper">
				<div class="avatar">
					<?php echo HTML::image($avatar, array('alt' => $author_name))?>
				</div>
				<div class="info">
					<div class="author"><?php echo $author_name?></div>
					<div class="date_create"><?php date("F j, Y, g:i a", $node->date_create)?></div>
					<?php if(isset($_user)):?>
					<div class="actions">
						<?php if($_is_admin):?>
						<div class="left">
								<?php echo HTML::anchor(
									Route::get('comments')->uri(
										array(
											'action' => 'delete',
											'object_id' => $node->id,
										)
									),
									__('delete'),
									array('class' => 'comment_delete button_black', 'title' => __('delete comment'))
								)?>
						</div>
						<?php endif;?>
						<div class="comment_add button_black" prev_id="<?php echo $node->id?>" place="inside" title="<?php echo __('your answer on this comment')?>"><?php echo __('comment')?></div>
					</div>
					<?php endif;?>
				</div>
			</div>

			<div class="text"><?php echo $node->text?></div>
		</div>
		<?php endif;?>
	<?php
	$level = $node->{$level_column};
	$first = FALSE;
	endforeach;
	?>
</li>
</ul>