<div class="registrationTeamsLocalities index">
	<h2><?php echo __('Registration Teams Localities'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('registration_team_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($registrationTeamsLocalities as $registrationTeamsLocality): ?>
	<tr>
		<td><?php echo h($registrationTeamsLocality['RegistrationTeamsLocality']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationTeamsLocality['Conference']['name'], array('controller' => 'conferences', 'action' => 'view', $registrationTeamsLocality['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($registrationTeamsLocality['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $registrationTeamsLocality['Locality']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($registrationTeamsLocality['RegistrationTeam']['name'], array('controller' => 'registration_teams', 'action' => 'view', $registrationTeamsLocality['RegistrationTeam']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $registrationTeamsLocality['RegistrationTeamsLocality']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $registrationTeamsLocality['RegistrationTeamsLocality']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $registrationTeamsLocality['RegistrationTeamsLocality']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeamsLocality['RegistrationTeamsLocality']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Registration Teams Locality'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('controller' => 'registration_teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team'), array('controller' => 'registration_teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
