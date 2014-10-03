<div class="registrationTeamMembers index">
	<h2><?php echo __('Registration Team Assignments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('registration_team_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($registrationTeamMembers as $registrationTeamMember): ?>
	<tr>
		<td><?php echo h($registrationTeamMember['RegistrationTeamMember']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationTeamMember['User']['id'], array('controller' => 'users', 'action' => 'view', $registrationTeamMember['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($registrationTeamMember['RegistrationTeam']['name'], array('controller' => 'registration_teams', 'action' => 'view', $registrationTeamMember['RegistrationTeam']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $registrationTeamMember['RegistrationTeamMember']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $registrationTeamMember['RegistrationTeamMember']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $registrationTeamMember['RegistrationTeamMember']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeamMember['RegistrationTeamMember']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('controller' => 'registration_teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team'), array('controller' => 'registration_teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
