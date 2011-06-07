<?php defined('SYSPATH') or die('No direct access allowed.');?>
<ul>
<?php
$level = $nodes->current()->{$level_column};
$first = TRUE;

foreach ($nodes as $node):?>
	<?php if ($node->{$level_column} > $level):?>
		<ul>
	<?php elseif ($node->{$level_column} < $level):?>
		</ul>
		</li>
	<?php elseif ( ! $first):?>
		</li>
	<?php endif;?>
	<li<?php echo ($node->lang->abbr != I18n::lang() ? ' class="another_lang"' : NULL)?>><a name="comment_<?php echo $node->id?>"></a>
		<div class="comment">
			<div class="info">
				<div class="avatar">
					<?php
					 $image = ($node->user->avatar)
							? 'media/images/avatars/'.$node->author->id.'/comment.png'
							: 'i/stubs/avatar_comment.png';
					echo HTML::image($image, array('alt' => $node->author->fullname))?>
				</div>
				<div class="author"><?php echo $node->author->fullname?></div>
				<div class="date_create"><?php echo I18n_Date::format($node->date_create, 'long')?></div>
			</div>
			<div class="actions">
				<?php if(isset($_user)):?>
				<div class="add_comment button_black" prev_id="<?php echo $node->id?>" place="inside" title="<?php echo __('your answer on this comment')?>"><?php echo __('comment')?></div>
				<?php endif;?>
			</div>
			<div class="text"><?php echo $node->text?></div>
		</div>
	<?php
	$level = $node->{$level_column};
	$first = FALSE;
	endforeach;
	?>
</li>
</ul>