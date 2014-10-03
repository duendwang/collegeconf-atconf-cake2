<div class="cancels index">
	<h2><?php echo __('Cancels'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('attendee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('reason'); ?></th>
			<th><?php echo $this->Paginator->sort('replaced'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cancels as $cancel): ?>
	<tr>
		<td><?php echo h($cancel['Cancel']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cancel['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $cancel['Attendee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cancel['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $cancel['Conference']['id'])); ?>
		</td>
		<td><?php echo h($cancel['Cancel']['reason']); ?>&nbsp;</td>
		<td><?php echo h($cancel['Cancel']['replaced']); ?>&nbsp;</td>
		<td><?php echo h($cancel['Cancel']['comment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cancel['Creator']['id'], array('controller' => 'users', 'action' => 'view', $cancel['Creator']['id'])); ?>
		</td>
		<td><?php echo h($cancel['Cancel']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cancel['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $cancel['Modifier']['id'])); ?>
		</td>
		<td><?php echo h($cancel['Cancel']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cancel['Cancel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cancel['Cancel']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cancel['Cancel']['id']), null, __('Are you sure you want to delete # %s?', $cancel['Cancel']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cancel'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
