<div class="conferenceDeadlines view">
<h2><?php  echo __('Conference Deadline'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadline['ConferenceDeadline']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadline['ConferenceDeadline']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weeks Before'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadline['ConferenceDeadline']['weeks_before']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weekday'); ?></dt>
		<dd>
			<?php echo $this->Html->link($conferenceDeadline['Weekday']['name'], array('controller' => 'weekdays', 'action' => 'view', $conferenceDeadline['Weekday']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadline['ConferenceDeadline']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Conference Deadline'), array('action' => 'edit', $conferenceDeadline['ConferenceDeadline']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Conference Deadline'), array('action' => 'delete', $conferenceDeadline['ConferenceDeadline']['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadline['ConferenceDeadline']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Weekdays'), array('controller' => 'weekdays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weekday'), array('controller' => 'weekdays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Conference Deadline Exceptions'); ?></h3>
	<?php if (!empty($conferenceDeadline['ConferenceDeadlineException'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Conference Deadline Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conferenceDeadline['ConferenceDeadlineException'] as $conferenceDeadlineException): ?>
		<tr>
			<td><?php echo $conferenceDeadlineException['id']; ?></td>
			<td><?php echo $conferenceDeadlineException['conference_id']; ?></td>
			<td><?php echo $conferenceDeadlineException['conference_deadline_id']; ?></td>
			<td><?php echo $conferenceDeadlineException['date']; ?></td>
			<td><?php echo $conferenceDeadlineException['time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'conference_deadline_exceptions', 'action' => 'view', $conferenceDeadlineException['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'conference_deadline_exceptions', 'action' => 'edit', $conferenceDeadlineException['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'conference_deadline_exceptions', 'action' => 'delete', $conferenceDeadlineException['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadlineException['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
