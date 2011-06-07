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
	<li><a name="comment_<?php echo $node->id?>"></a>
		<div class="comment">
			<div class="info">
				<div class="avatar">
					<?php
					 $image = ($node->user->avatar)
							? 'media/images/avatars/'.$node->user->id.'/comment.png'
							: 'i/stubs/avatar_comment.png';
					echo HTML::image($image, array('alt' => $node->user->fullname))?>
				</div>
				<div class="author"><?php echo $node->user->fullname?></div>
				<div class="date_create"><?php echo I18n_Date::format($node->date_create, 'long')?></div>
			</div>
			<div class="actions">
				<?php if(isset($_user)):?>
				<div class="add_comment button_black" prev_id="<?php echo $node->id?>" place="inside" title="<?php echo __('комментировать')?>"><?php echo __('комментировать')?></div>
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