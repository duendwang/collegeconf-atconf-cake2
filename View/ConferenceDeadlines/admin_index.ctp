<div class="conferenceDeadlines index">
	<h2><?php echo __('Conference Deadlines'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('weeks_before'); ?></th>
			<th><?php echo $this->Paginator->sort('weekday_id'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($conferenceDeadlines as $conferenceDeadline): ?>
	<tr>
		<td><?php echo h($conferenceDeadline['ConferenceDeadline']['id']); ?>&nbsp;</td>
		<td><?php echo h($conferenceDeadline['ConferenceDeadline']['name']); ?>&nbsp;</td>
		<td><?php echo h($conferenceDeadline['ConferenceDeadline']['weeks_before']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($conferenceDeadline['Weekday']['name'], array('controller' => 'weekdays', 'action' => 'view', $conferenceDeadline['Weekday']['id'])); ?>
		</td>
		<td><?php echo h($conferenceDeadline['ConferenceDeadline']['time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $conferenceDeadline['ConferenceDeadline']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $conferenceDeadline['ConferenceDeadline']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $conferenceDeadline['ConferenceDeadline']['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadline['ConferenceDeadline']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Weekdays'), array('controller' => 'weekdays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weekday'), array('controller' => 'weekdays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
	</ul>
</div>
