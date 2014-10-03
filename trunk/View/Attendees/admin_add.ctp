<div class="attendees form">
<?php echo $this->Form->create('Attendee'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Attendee'); ?></legend>
	<?php
		echo $this->Form->input('conference_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('campus_id');
		echo $this->Form->input('lrc');
		echo $this->Form->input('conf_contact');
		echo $this->Form->input('new_one');
		echo $this->Form->input('group');
		echo $this->Form->input('allergies');
		echo $this->Form->input('status_id');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('email');
		echo $this->Form->input('city_state');
		echo $this->Form->input('lodging_id');
		echo $this->Form->input('submitter');
		echo $this->Form->input('rate');
		echo $this->Form->input('paid_at_conf');
		echo $this->Form->input('comment');
		echo $this->Form->input('amt_paid');
		echo $this->Form->input('check_num');
		echo $this->Form->input('paid_date');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('controller' => 'attendees_finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee Finance Add'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
