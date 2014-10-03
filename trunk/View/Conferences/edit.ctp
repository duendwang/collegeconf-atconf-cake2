<div class="conferences form">
<?php echo $this->Form->create('Conference'); ?>
	<fieldset>
		<legend><?php echo __('Edit Conference'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('term');
		echo $this->Form->input('year');
		echo $this->Form->input('part');
		echo $this->Form->input('conference_location_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Conference.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Conference.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('controller' => 'registration_steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
