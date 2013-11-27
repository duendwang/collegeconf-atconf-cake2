<div class="attendeesFinances index">
	<h2><?php echo __('Attendees Finances'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('finance_id'); ?></th>
			<th><?php echo $this->Paginator->sort('add_attendee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cancel_attendee_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attendeesFinances as $attendeesFinance): ?>
	<tr>
		<td><?php echo h($attendeesFinance['AttendeesFinance']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendeesFinance['Finance']['id'], array('controller' => 'finances', 'action' => 'view', $attendeesFinance['Finance']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attendeesFinance['AddAttendee']['name'], array('controller' => 'attendees', 'action' => 'view', $attendeesFinance['AddAttendee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attendeesFinance['CancelAttendee']['name'], array('controller' => 'attendees', 'action' => 'view', $attendeesFinance['CancelAttendee']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attendeesFinance['AttendeesFinance']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attendeesFinance['AttendeesFinance']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attendeesFinance['AttendeesFinance']['id']), null, __('Are you sure you want to delete # %s?', $attendeesFinance['AttendeesFinance']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Attendees Finance'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Add'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
