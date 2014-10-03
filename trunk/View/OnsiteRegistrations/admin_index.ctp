<div class="onsiteRegistrations index">
	<h2><?php echo __('Onsite Registrations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attendee_id'); ?></th>
			<th><?php echo $this->Paginator->sort('registration'); ?></th>
			<th><?php echo $this->Paginator->sort('cashier'); ?></th>
			<th><?php echo $this->Paginator->sort('hospitality'); ?></th>
			<th><?php echo $this->Paginator->sort('badge'); ?></th>
			<th><?php echo $this->Paginator->sort('need_cashier'); ?></th>
			<th><?php echo $this->Paginator->sort('need_hospitality'); ?></th>
			<th><?php echo $this->Paginator->sort('need_badge'); ?></th>
			<th><?php echo $this->Paginator->sort('need_old'); ?></th>
			<th><?php echo $this->Paginator->sort('old_first'); ?></th>
			<th><?php echo $this->Paginator->sort('old_last'); ?></th>
			<th><?php echo $this->Paginator->sort('old_locality_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($onsiteRegistrations as $onsiteRegistration): ?>
	<tr>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($onsiteRegistration['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $onsiteRegistration['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($onsiteRegistration['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $onsiteRegistration['Attendee']['id'])); ?>
		</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['registration']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['cashier']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['hospitality']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['badge']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['need_cashier']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['need_hospitality']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['need_badge']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['need_old']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['old_first']); ?>&nbsp;</td>
		<td><?php echo h($onsiteRegistration['OnsiteRegistration']['old_last']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($onsiteRegistration['OldLocality']['name'], array('controller' => 'localities', 'action' => 'view', $onsiteRegistration['OldLocality']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $onsiteRegistration['OnsiteRegistration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $onsiteRegistration['OnsiteRegistration']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $onsiteRegistration['OnsiteRegistration']['id']), null, __('Are you sure you want to delete # %s?', $onsiteRegistration['OnsiteRegistration']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Old Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
