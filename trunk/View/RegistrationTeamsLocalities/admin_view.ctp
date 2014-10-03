<div class="registrationTeamsLocalities view">
<h2><?php echo __('Registration Teams Locality'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registrationTeamsLocality['RegistrationTeamsLocality']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationTeamsLocality['Conference']['name'], array('controller' => 'conferences', 'action' => 'view', $registrationTeamsLocality['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationTeamsLocality['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $registrationTeamsLocality['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registration Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationTeamsLocality['RegistrationTeam']['name'], array('controller' => 'registration_teams', 'action' => 'view', $registrationTeamsLocality['RegistrationTeam']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Registration Teams Locality'), array('action' => 'edit', $registrationTeamsLocality['RegistrationTeamsLocality']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Registration Teams Locality'), array('action' => 'delete', $registrationTeamsLocality['RegistrationTeamsLocality']['id']), null, __('Are you sure you want to delete # %s?', $registrationTeamsLocality['RegistrationTeamsLocality']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams Localities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Teams Locality'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Teams'), array('controller' => 'registration_teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team'), array('controller' => 'registration_teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
