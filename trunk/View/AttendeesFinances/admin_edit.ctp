<div class="attendeesFinances form">
<?php echo $this->Form->create('AttendeesFinance'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Attendees Finance'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('finance_id');
		echo $this->Form->input('add_attendee_id');
		echo $this->Form->input('cancel_attendee_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AttendeesFinance.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AttendeesFinance.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Add'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
