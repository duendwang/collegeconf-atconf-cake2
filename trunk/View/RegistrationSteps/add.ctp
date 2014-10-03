<div class="registrationSteps form">
<?php echo $this->Form->create('RegistrationStep'); ?>
	<fieldset>
		<legend><?php echo __('Add Registration Step'); ?></legend>
	<?php
		echo $this->Form->input('conference_id');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('active');
		echo $this->Form->input('user_id');
		echo $this->Form->input('instructions_sent');
		echo $this->Form->input('receipt_confirmation');
		echo $this->Form->input('update_lrc');
		echo $this->Form->input('first_reminder');
		echo $this->Form->input('first_registrants_received');
		echo $this->Form->input('first_check_registrations');
		echo $this->Form->input('lrc_asked_update');
		echo $this->Form->input('count_by_rate');
		echo $this->Form->input('compose_reg_confirmation');
		echo $this->Form->input('first_check_send');
		echo $this->Form->input('first_update_finances');
		echo $this->Form->input('second_reminder');
		echo $this->Form->input('second_registrants_received');
		echo $this->Form->input('second_check_registrations');
		echo $this->Form->input('second_update_finances');
		echo $this->Form->input('compose_initial_summary');
		echo $this->Form->input('second_check_send');
		echo $this->Form->input('cc_bro_verify');
		echo $this->Form->input('cc_bro_sign');
		echo $this->Form->input('cc_sis_verify');
		echo $this->Form->input('cc_sis_sign');
		echo $this->Form->input('compose_final_summary');
		echo $this->Form->input('third_check_send');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Registration Steps'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
