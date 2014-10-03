<div class="conferenceDeadlineExceptions form">
<?php echo $this->Form->create('ConferenceDeadlineException'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Conference Deadline Exception'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('controller' => 'conference_deadlines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
	</ul>
</div>
