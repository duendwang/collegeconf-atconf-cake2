<div class="weekdays view">
<h2><?php  echo __('Weekday'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($weekday['Weekday']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($weekday['Weekday']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($weekday['Weekday']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Weekday'), array('action' => 'edit', $weekday['Weekday']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Weekday'), array('action' => 'delete', $weekday['Weekday']['id']), null, __('Are you sure you want to delete # %s?', $weekday['Weekday']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Weekdays'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weekday'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('controller' => 'conference_deadlines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Conference Deadlines'); ?></h3>
	<?php if (!empty($weekday['ConferenceDeadline'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Weeks Before'); ?></th>
		<th><?php echo __('Weekday Id'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($weekday['ConferenceDeadline'] as $conferenceDeadline): ?>
		<tr>
			<td><?php echo $conferenceDeadline['id']; ?></td>
			<td><?php echo $conferenceDeadline['name']; ?></td>
			<td><?php echo $conferenceDeadline['weeks_before']; ?></td>
			<td><?php echo $conferenceDeadline['weekday_id']; ?></td>
			<td><?php echo $conferenceDeadline['time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'conference_deadlines', 'action' => 'view', $conferenceDeadline['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'conference_deadlines', 'action' => 'edit', $conferenceDeadline['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'conference_deadlines', 'action' => 'delete', $conferenceDeadline['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadline['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
