<div class="lodgingFacilities index">
	<h2><?php echo __('Lodging Facilities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_location_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('room'); ?></th>
			<th><?php echo $this->Paginator->sort('accomodations'); ?></th>
			<th><?php echo $this->Paginator->sort('capacity'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('comments'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lodgingFacilities as $lodgingFacility): ?>
	<tr>
		<td><?php echo h($lodgingFacility['LodgingFacility']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lodgingFacility['ConferenceLocation']['name'], array('controller' => 'conference_locations', 'action' => 'view', $lodgingFacility['ConferenceLocation']['id'])); ?>
		</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['code']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['location']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['room']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['accomodations']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['capacity']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['address']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['city']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['zip']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['phone']); ?>&nbsp;</td>
		<td><?php echo h($lodgingFacility['LodgingFacility']['comments']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lodgingFacility['LodgingFacility']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lodgingFacility['LodgingFacility']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lodgingFacility['LodgingFacility']['id']), null, __('Are you sure you want to delete # %s?', $lodgingFacility['LodgingFacility']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lodging Facility'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
