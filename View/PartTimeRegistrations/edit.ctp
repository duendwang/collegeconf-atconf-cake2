<div class="partTimeRegistrations form">
<?php echo $this->Form->create('PartTimeRegistration'); ?>
	<fieldset>
		<legend><?php echo __('Edit Part Time Registration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conference_id');
		echo $this->Form->input('attendee_id');
		echo $this->Form->input('fri_din');
		echo $this->Form->input('fri_mtg');
		echo $this->Form->input('fri_hosp');
		echo $this->Form->input('sat_bkfst');
		echo $this->Form->input('sat_mtg1');
		echo $this->Form->input('sat_lun');
		echo $this->Form->input('sat_mtg2');
		echo $this->Form->input('sat_din');
		echo $this->Form->input('sat_mtg3');
		echo $this->Form->input('sat_hosp');
		echo $this->Form->input('ld_bkfst');
		echo $this->Form->input('ld_mtg');
		echo $this->Form->input('ld_lun');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PartTimeRegistration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PartTimeRegistration.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
