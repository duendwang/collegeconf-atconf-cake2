<div class="registrationTeams index">
	<h2><?php echo __('Registration Teams'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($registrationTeams as $registrationTeam): ?>
	<tr>
		<td><?php echo h($registrationTeam['RegistrationTeam']['id']); ?>&nbsp;</td>
		<td><?php echo h($registrationTeam['RegistrationTeam']['name']); ?>&nbsp;</td>
		<td><?php echo h($registrationTeam['RegistrationTeam']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $registrationTeam['RegistrationTeam']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $registrationTeam['RegistrationTeam']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $registrationTeam['RegistrationTeam']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeam['RegistrationTeam']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Registration Team'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Registration Team Assignments'), array('controller' => 'registration_team_assignments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'add')); ?> </li>
	</ul>
</div>
