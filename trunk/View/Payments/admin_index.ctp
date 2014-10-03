<div class="payments index">
	<h2><?php echo __('Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attendee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cash'); ?></th>
			<th><?php echo $this->Paginator->sort('check_number'); ?></th>
			<th><?php echo $this->Paginator->sort('check'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_paid'); ?></th>
			<th><?php echo $this->Paginator->sort('bill_locality'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $payment['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($payment['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $payment['Attendee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($payment['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $payment['Locality']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['cash']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['check_number']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['check']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['locality_paid']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['bill_locality']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['comment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Creator']['id'], array('controller' => 'users', 'action' => 'view', $payment['Creator']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $payment['Modifier']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), null, __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
