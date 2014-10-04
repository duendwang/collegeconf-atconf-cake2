<div class="registrationTeamMembers view">
<h2><?php  echo __('Registration Team Assignment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registrationTeamMember['RegistrationTeamMember']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationTeamMember['User']['id'], array('controller' => 'users', 'action' => 'view', $registrationTeamMember['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registration Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationTeamMember['RegistrationTeam']['name'], array('controller' => 'registration_teams', 'action' => 'view', $registrationTeamMember['RegistrationTeam']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Registration Team Assignment'), array('action' => 'edit', $registrationTeamMember['RegistrationTeamMember']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Registration Team Assignment'), array('action' => 'delete', $registrationTeamMember['RegistrationTeamMember']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeamMember['RegistrationTeamMember']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Team Assignments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('controller' => 'registration_teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team'), array('controller' => 'registration_teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
