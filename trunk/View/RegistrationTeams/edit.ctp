<div class="registrationTeams form">
<?php echo $this->Form->create('RegistrationTeam'); ?>
	<fieldset>
		<legend><?php echo __('Edit Registration Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RegistrationTeam.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RegistrationTeam.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Registration Team Assignments'), array('controller' => 'registration_team_assignments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'add')); ?> </li>
	</ul>
</div>
