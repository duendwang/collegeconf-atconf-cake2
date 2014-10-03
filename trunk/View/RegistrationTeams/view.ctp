<div class="registrationTeams view">
<h2><?php  echo __('Registration Team'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registrationTeam['RegistrationTeam']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($registrationTeam['RegistrationTeam']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($registrationTeam['RegistrationTeam']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Registration Team'), array('action' => 'edit', $registrationTeam['RegistrationTeam']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Registration Team'), array('action' => 'delete', $registrationTeam['RegistrationTeam']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeam['RegistrationTeam']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Team Assignments'), array('controller' => 'registration_team_assignments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Registration Team Assignments'); ?></h3>
	<?php if (!empty($registrationTeam['RegistrationTeamAssignment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Registration Team Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($registrationTeam['RegistrationTeamAssignment'] as $registrationTeamAssignment): ?>
		<tr>
			<td><?php echo $registrationTeamAssignment['id']; ?></td>
			<td><?php echo $registrationTeamAssignment['user_id']; ?></td>
			<td><?php echo $registrationTeamAssignment['registration_team_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'registration_team_assignments', 'action' => 'view', $registrationTeamAssignment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'registration_team_assignments', 'action' => 'edit', $registrationTeamAssignment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'registration_team_assignments', 'action' => 'delete', $registrationTeamAssignment['id']), null, __('Are you sure you want to delete # %s?', $registrationTeamAssignment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
