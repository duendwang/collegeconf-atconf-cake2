<div class="registrationSteps index">
	<h2><?php echo __('Registration Steps'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('instructions_sent'); ?></th>
			<th><?php echo $this->Paginator->sort('receipt_confirmation'); ?></th>
			<th><?php echo $this->Paginator->sort('update_lrc'); ?></th>
			<th><?php echo $this->Paginator->sort('first_reminder'); ?></th>
			<th><?php echo $this->Paginator->sort('first_registrants_received'); ?></th>
			<th><?php echo $this->Paginator->sort('first_check_registrations'); ?></th>
			<th><?php echo $this->Paginator->sort('lrc_asked_update'); ?></th>
			<th><?php echo $this->Paginator->sort('count_by_rate'); ?></th>
			<th><?php echo $this->Paginator->sort('compose_reg_confirmation'); ?></th>
			<th><?php echo $this->Paginator->sort('first_check_send'); ?></th>
			<th><?php echo $this->Paginator->sort('first_update_finances'); ?></th>
			<th><?php echo $this->Paginator->sort('second_reminder'); ?></th>
			<th><?php echo $this->Paginator->sort('second_registrants_received'); ?></th>
			<th><?php echo $this->Paginator->sort('second_check_registrations'); ?></th>
			<th><?php echo $this->Paginator->sort('second_update_finances'); ?></th>
			<th><?php echo $this->Paginator->sort('compose_initial_summary'); ?></th>
			<th><?php echo $this->Paginator->sort('second_check_send'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_bro_verify'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_bro_sign'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_sis_verify'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_sis_sign'); ?></th>
			<th><?php echo $this->Paginator->sort('compose_final_summary'); ?></th>
			<th><?php echo $this->Paginator->sort('third_check_send'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($registrationSteps as $registrationStep): ?>
	<tr>
		<td><?php echo h($registrationStep['RegistrationStep']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationStep['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $registrationStep['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($registrationStep['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $registrationStep['Locality']['id'])); ?>
		</td>
		<td><?php echo h($registrationStep['RegistrationStep']['active']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationStep['User']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['User']['id'])); ?>
		</td>
		<td><?php echo h($registrationStep['RegistrationStep']['instructions_sent']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['receipt_confirmation']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['update_lrc']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['first_reminder']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['first_registrants_received']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['first_check_registrations']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['lrc_asked_update']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['count_by_rate']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['compose_reg_confirmation']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['first_check_send']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['first_update_finances']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['second_reminder']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['second_registrants_received']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['second_check_registrations']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['second_update_finances']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['compose_initial_summary']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['second_check_send']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['cc_bro_verify']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['cc_bro_sign']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['cc_sis_verify']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['cc_sis_sign']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['compose_final_summary']); ?>&nbsp;</td>
		<td><?php echo h($registrationStep['RegistrationStep']['third_check_send']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationStep['Creator']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['Creator']['id'])); ?>
		</td>
		<td><?php echo h($registrationStep['RegistrationStep']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($registrationStep['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['Modifier']['id'])); ?>
		</td>
		<td><?php echo h($registrationStep['RegistrationStep']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $registrationStep['RegistrationStep']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $registrationStep['RegistrationStep']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $registrationStep['RegistrationStep']['id']), null, __('Are you sure you want to delete # %s?', $registrationStep['RegistrationStep']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Registration Step'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
