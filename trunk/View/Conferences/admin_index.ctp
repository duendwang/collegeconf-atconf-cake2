<div class="conferences index">
	<h2><?php echo __('Conferences'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('term'); ?></th>
			<th><?php echo $this->Paginator->sort('year'); ?></th>
			<th><?php echo $this->Paginator->sort('part'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('start_date'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($conferences as $conference): ?>
	<tr>
		<td><?php echo h($conference['Conference']['id']); ?>&nbsp;</td>
		<td><?php echo h($conference['Conference']['term']); ?>&nbsp;</td>
		<td><?php echo h($conference['Conference']['year']); ?>&nbsp;</td>
		<td><?php echo h($conference['Conference']['part']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($conference['ConferenceLocation']['name'], array('controller' => 'conference_locations', 'action' => 'view', $conference['ConferenceLocation']['id'])); ?>
		</td>
		<td><?php echo h($conference['Conference']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($conference['Conference']['code']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $conference['Conference']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $conference['Conference']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $conference['Conference']['id']), null, __('Are you sure you want to delete # %s?', $conference['Conference']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Conference'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('controller' => 'registration_steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
