<div class="onsiteRegistrations form">
<?php echo $this->Form->create('OnsiteRegistration'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Onsite Registration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conference_id');
		echo $this->Form->input('attendee_id');
		echo $this->Form->input('registration');
		echo $this->Form->input('cashier');
		echo $this->Form->input('hospitality');
		echo $this->Form->input('badge');
		echo $this->Form->input('need_cashier');
		echo $this->Form->input('need_hospitality');
		echo $this->Form->input('need_badge');
		echo $this->Form->input('need_old');
		echo $this->Form->input('old_first');
		echo $this->Form->input('old_last');
		echo $this->Form->input('old_locality_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OnsiteRegistration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OnsiteRegistration.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Old Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
