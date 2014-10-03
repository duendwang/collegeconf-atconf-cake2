<div class="partTimeRegistrations index">
	<h2><?php echo __('Part Time Registrations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attendee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('fri_din'); ?></th>
			<th><?php echo $this->Paginator->sort('fri_mtg'); ?></th>
			<th><?php echo $this->Paginator->sort('fri_hosp'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_bkfst'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_mtg1'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_lun'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_mtg2'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_din'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_mtg3'); ?></th>
			<th><?php echo $this->Paginator->sort('sat_hosp'); ?></th>
			<th><?php echo $this->Paginator->sort('ld_bkfst'); ?></th>
			<th><?php echo $this->Paginator->sort('ld_mtg'); ?></th>
			<th><?php echo $this->Paginator->sort('ld_lun'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($partTimeRegistrations as $partTimeRegistration): ?>
	<tr>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($partTimeRegistration['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $partTimeRegistration['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($partTimeRegistration['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $partTimeRegistration['Attendee']['id'])); ?>
		</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['fri_din']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['fri_mtg']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['fri_hosp']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_bkfst']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg1']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_lun']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg2']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_din']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg3']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['sat_hosp']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['ld_bkfst']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['ld_mtg']); ?>&nbsp;</td>
		<td><?php echo h($partTimeRegistration['PartTimeRegistration']['ld_lun']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $partTimeRegistration['PartTimeRegistration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $partTimeRegistration['PartTimeRegistration']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $partTimeRegistration['PartTimeRegistration']['id']), null, __('Are you sure you want to delete # %s?', $partTimeRegistration['PartTimeRegistration']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
