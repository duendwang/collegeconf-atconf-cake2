<div class="registrationSteps view">
<h2><?php  echo __('Registration Step'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationStep['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $registrationStep['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationStep['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $registrationStep['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationStep['User']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instructions Sent'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['instructions_sent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receipt Confirmation'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['receipt_confirmation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update Lrc'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['update_lrc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Reminder'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['first_reminder']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Registrants Received'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['first_registrants_received']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Check Registrations'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['first_check_registrations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lrc Asked Update'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['lrc_asked_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Count By Rate'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['count_by_rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Compose Reg Confirmation'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['compose_reg_confirmation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Check Send'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['first_check_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Update Finances'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['first_update_finances']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Reminder'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['second_reminder']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Registrants Received'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['second_registrants_received']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Check Registrations'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['second_check_registrations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Update Finances'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['second_update_finances']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Compose Initial Summary'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['compose_initial_summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Check Send'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['second_check_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Bro Verify'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['cc_bro_verify']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Bro Sign'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['cc_bro_sign']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Sis Verify'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['cc_sis_verify']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Sis Sign'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['cc_sis_sign']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Compose Final Summary'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['compose_final_summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Third Check Send'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['third_check_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationStep['Creator']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($registrationStep['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $registrationStep['Modifier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($registrationStep['RegistrationStep']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Registration Step'), array('action' => 'edit', $registrationStep['RegistrationStep']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Registration Step'), array('action' => 'delete', $registrationStep['RegistrationStep']['id']), null, __('Are you sure you want to delete # %s?', $registrationStep['RegistrationStep']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
