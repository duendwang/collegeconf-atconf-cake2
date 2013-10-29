<div class="conferenceDeadlineExceptions form">
<?php echo $this->Form->create('ConferenceDeadlineException'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Conference Deadline Exception'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conference_id');
		echo $this->Form->input('conference_deadline_id');
		echo $this->Form->input('date');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ConferenceDeadlineException.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ConferenceDeadlineException.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('controller' => 'conference_deadlines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
	</ul>
</div>
