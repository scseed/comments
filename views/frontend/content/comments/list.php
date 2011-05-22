<?php defined('SYSPATH') or die('No direct access allowed.');?>
<ul id="comments">
<?php
$level = $nodes->current()->{$level_column};
$first = TRUE;

foreach ($nodes as $node): ?>
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
				<div class="author"><?php echo $node->author->user_data->last_name?></div>
				<div class="date_create"><?php echo date('r', $node->date_create)?></div>
				<div class="actions">
					<?php if(isset($_user)):?><div class="add_comment" prev_id="<?php echo $node->id?>" place="inside" title="Ответить на комментарий">[ &larr; ]</div><?php endif;?>
				</div>
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