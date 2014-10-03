<div class="conferenceDeadlines form">
<?php echo $this->Form->create('ConferenceDeadline'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Conference Deadline'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('weeks_before');
		echo $this->Form->input('weekday_id');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ConferenceDeadline.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ConferenceDeadline.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Weekdays'), array('controller' => 'weekdays', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Weekday'), array('controller' => 'weekdays', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
	</ul>
</div>
