<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City State'); ?></dt>
		<dd>
			<?php echo h($user['User']['city_state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $user['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $user['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Campus'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Campus']['name'], array('controller' => 'campuses', 'action' => 'view', $user['Campus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_login']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Team Assignments'), array('controller' => 'registration_team_assignments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('controller' => 'registration_steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee Create'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel Create'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emails'), array('controller' => 'emails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Create'), array('controller' => 'emails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Create'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Create'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Registration Team Assignments'); ?></h3>
	<?php if (!empty($user['RegistrationTeamAssignment'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['RegistrationTeamAssignment']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['RegistrationTeamAssignment']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Registration Team Id'); ?></dt>
		<dd>
	<?php echo $user['RegistrationTeamAssignment']['registration_team_id']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Registration Team Assignment'), array('controller' => 'registration_team_assignments', 'action' => 'edit', $user['RegistrationTeamAssignment']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related User Types'); ?></h3>
	<?php if (!empty($user['UserType'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['UserType']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['UserType']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Account Type Id'); ?></dt>
		<dd>
	<?php echo $user['UserType']['account_type_id']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User Type'), array('controller' => 'user_types', 'action' => 'edit', $user['UserType']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Registration Steps'); ?></h3>
	<?php if (!empty($user['RegistrationStep'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Instructions Sent'); ?></th>
		<th><?php echo __('Receipt Confirmation'); ?></th>
		<th><?php echo __('Update Lrc'); ?></th>
		<th><?php echo __('First Reminder'); ?></th>
		<th><?php echo __('First Registrants Received'); ?></th>
		<th><?php echo __('First Check Registrations'); ?></th>
		<th><?php echo __('Lrc Asked Update'); ?></th>
		<th><?php echo __('Count By Rate'); ?></th>
		<th><?php echo __('Compose Reg Confirmation'); ?></th>
		<th><?php echo __('First Check Send'); ?></th>
		<th><?php echo __('First Update Finances'); ?></th>
		<th><?php echo __('Second Reminder'); ?></th>
		<th><?php echo __('Second Registrants Received'); ?></th>
		<th><?php echo __('Second Check Registrations'); ?></th>
		<th><?php echo __('Second Update Finances'); ?></th>
		<th><?php echo __('Compose Initial Summary'); ?></th>
		<th><?php echo __('Second Check Send'); ?></th>
		<th><?php echo __('Cc Bro Verify'); ?></th>
		<th><?php echo __('Cc Bro Sign'); ?></th>
		<th><?php echo __('Cc Sis Verify'); ?></th>
		<th><?php echo __('Cc Sis Sign'); ?></th>
		<th><?php echo __('Compose Final Summary'); ?></th>
		<th><?php echo __('Third Check Send'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['RegistrationStep'] as $registrationStep): ?>
		<tr>
			<td><?php echo $registrationStep['id']; ?></td>
			<td><?php echo $registrationStep['conference_id']; ?></td>
			<td><?php echo $registrationStep['locality_id']; ?></td>
			<td><?php echo $registrationStep['active']; ?></td>
			<td><?php echo $registrationStep['user_id']; ?></td>
			<td><?php echo $registrationStep['instructions_sent']; ?></td>
			<td><?php echo $registrationStep['receipt_confirmation']; ?></td>
			<td><?php echo $registrationStep['update_lrc']; ?></td>
			<td><?php echo $registrationStep['first_reminder']; ?></td>
			<td><?php echo $registrationStep['first_registrants_received']; ?></td>
			<td><?php echo $registrationStep['first_check_registrations']; ?></td>
			<td><?php echo $registrationStep['lrc_asked_update']; ?></td>
			<td><?php echo $registrationStep['count_by_rate']; ?></td>
			<td><?php echo $registrationStep['compose_reg_confirmation']; ?></td>
			<td><?php echo $registrationStep['first_check_send']; ?></td>
			<td><?php echo $registrationStep['first_update_finances']; ?></td>
			<td><?php echo $registrationStep['second_reminder']; ?></td>
			<td><?php echo $registrationStep['second_registrants_received']; ?></td>
			<td><?php echo $registrationStep['second_check_registrations']; ?></td>
			<td><?php echo $registrationStep['second_update_finances']; ?></td>
			<td><?php echo $registrationStep['compose_initial_summary']; ?></td>
			<td><?php echo $registrationStep['second_check_send']; ?></td>
			<td><?php echo $registrationStep['cc_bro_verify']; ?></td>
			<td><?php echo $registrationStep['cc_bro_sign']; ?></td>
			<td><?php echo $registrationStep['cc_sis_verify']; ?></td>
			<td><?php echo $registrationStep['cc_sis_sign']; ?></td>
			<td><?php echo $registrationStep['compose_final_summary']; ?></td>
			<td><?php echo $registrationStep['third_check_send']; ?></td>
			<td><?php echo $registrationStep['creator_id']; ?></td>
			<td><?php echo $registrationStep['created']; ?></td>
			<td><?php echo $registrationStep['modifier_id']; ?></td>
			<td><?php echo $registrationStep['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'registration_steps', 'action' => 'view', $registrationStep['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'registration_steps', 'action' => 'edit', $registrationStep['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'registration_steps', 'action' => 'delete', $registrationStep['id']), null, __('Are you sure you want to delete # %s?', $registrationStep['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees'); ?></h3>
	<?php if (!empty($user['AttendeeCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Campus Id'); ?></th>
		<th><?php echo __('Lrc'); ?></th>
		<th><?php echo __('Conf Contact'); ?></th>
		<th><?php echo __('New One'); ?></th>
		<th><?php echo __('Group'); ?></th>
		<th><?php echo __('Allergies'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Cell Phone'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('City State'); ?></th>
		<th><?php echo __('Lodging Id'); ?></th>
		<th><?php echo __('Submitter'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Paid At Conf'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Amt Paid'); ?></th>
		<th><?php echo __('Check Num'); ?></th>
		<th><?php echo __('Paid Date'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AttendeeCreate'] as $attendeeCreate): ?>
		<tr>
			<td><?php echo $attendeeCreate['id']; ?></td>
			<td><?php echo $attendeeCreate['conference_id']; ?></td>
			<td><?php echo $attendeeCreate['first_name']; ?></td>
			<td><?php echo $attendeeCreate['last_name']; ?></td>
			<td><?php echo $attendeeCreate['gender']; ?></td>
			<td><?php echo $attendeeCreate['locality_id']; ?></td>
			<td><?php echo $attendeeCreate['campus_id']; ?></td>
			<td><?php echo $attendeeCreate['lrc']; ?></td>
			<td><?php echo $attendeeCreate['conf_contact']; ?></td>
			<td><?php echo $attendeeCreate['new_one']; ?></td>
			<td><?php echo $attendeeCreate['group']; ?></td>
			<td><?php echo $attendeeCreate['allergies']; ?></td>
			<td><?php echo $attendeeCreate['status_id']; ?></td>
			<td><?php echo $attendeeCreate['cell_phone']; ?></td>
			<td><?php echo $attendeeCreate['email']; ?></td>
			<td><?php echo $attendeeCreate['city_state']; ?></td>
			<td><?php echo $attendeeCreate['lodging_id']; ?></td>
			<td><?php echo $attendeeCreate['submitter']; ?></td>
			<td><?php echo $attendeeCreate['rate']; ?></td>
			<td><?php echo $attendeeCreate['paid_at_conf']; ?></td>
			<td><?php echo $attendeeCreate['comment']; ?></td>
			<td><?php echo $attendeeCreate['amt_paid']; ?></td>
			<td><?php echo $attendeeCreate['check_num']; ?></td>
			<td><?php echo $attendeeCreate['paid_date']; ?></td>
			<td><?php echo $attendeeCreate['creator_id']; ?></td>
			<td><?php echo $attendeeCreate['created']; ?></td>
			<td><?php echo $attendeeCreate['modifier_id']; ?></td>
			<td><?php echo $attendeeCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees', 'action' => 'view', $attendeeCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees', 'action' => 'edit', $attendeeCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees', 'action' => 'delete', $attendeeCreate['id']), null, __('Are you sure you want to delete # %s?', $attendeeCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attendee Create'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees'); ?></h3>
	<?php if (!empty($user['AttendeeModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Campus Id'); ?></th>
		<th><?php echo __('Lrc'); ?></th>
		<th><?php echo __('Conf Contact'); ?></th>
		<th><?php echo __('New One'); ?></th>
		<th><?php echo __('Group'); ?></th>
		<th><?php echo __('Allergies'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Cell Phone'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('City State'); ?></th>
		<th><?php echo __('Lodging Id'); ?></th>
		<th><?php echo __('Submitter'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Paid At Conf'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Amt Paid'); ?></th>
		<th><?php echo __('Check Num'); ?></th>
		<th><?php echo __('Paid Date'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AttendeeModify'] as $attendeeModify): ?>
		<tr>
			<td><?php echo $attendeeModify['id']; ?></td>
			<td><?php echo $attendeeModify['conference_id']; ?></td>
			<td><?php echo $attendeeModify['first_name']; ?></td>
			<td><?php echo $attendeeModify['last_name']; ?></td>
			<td><?php echo $attendeeModify['gender']; ?></td>
			<td><?php echo $attendeeModify['locality_id']; ?></td>
			<td><?php echo $attendeeModify['campus_id']; ?></td>
			<td><?php echo $attendeeModify['lrc']; ?></td>
			<td><?php echo $attendeeModify['conf_contact']; ?></td>
			<td><?php echo $attendeeModify['new_one']; ?></td>
			<td><?php echo $attendeeModify['group']; ?></td>
			<td><?php echo $attendeeModify['allergies']; ?></td>
			<td><?php echo $attendeeModify['status_id']; ?></td>
			<td><?php echo $attendeeModify['cell_phone']; ?></td>
			<td><?php echo $attendeeModify['email']; ?></td>
			<td><?php echo $attendeeModify['city_state']; ?></td>
			<td><?php echo $attendeeModify['lodging_id']; ?></td>
			<td><?php echo $attendeeModify['submitter']; ?></td>
			<td><?php echo $attendeeModify['rate']; ?></td>
			<td><?php echo $attendeeModify['paid_at_conf']; ?></td>
			<td><?php echo $attendeeModify['comment']; ?></td>
			<td><?php echo $attendeeModify['amt_paid']; ?></td>
			<td><?php echo $attendeeModify['check_num']; ?></td>
			<td><?php echo $attendeeModify['paid_date']; ?></td>
			<td><?php echo $attendeeModify['creator_id']; ?></td>
			<td><?php echo $attendeeModify['created']; ?></td>
			<td><?php echo $attendeeModify['modifier_id']; ?></td>
			<td><?php echo $attendeeModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees', 'action' => 'view', $attendeeModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees', 'action' => 'edit', $attendeeModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees', 'action' => 'delete', $attendeeModify['id']), null, __('Are you sure you want to delete # %s?', $attendeeModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attendee Modify'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Cancels'); ?></h3>
	<?php if (!empty($user['CancelCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Reason'); ?></th>
		<th><?php echo __('Replaced'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['CancelCreate'] as $cancelCreate): ?>
		<tr>
			<td><?php echo $cancelCreate['id']; ?></td>
			<td><?php echo $cancelCreate['attendee_id']; ?></td>
			<td><?php echo $cancelCreate['conference_id']; ?></td>
			<td><?php echo $cancelCreate['reason']; ?></td>
			<td><?php echo $cancelCreate['replaced']; ?></td>
			<td><?php echo $cancelCreate['comment']; ?></td>
			<td><?php echo $cancelCreate['creator_id']; ?></td>
			<td><?php echo $cancelCreate['created']; ?></td>
			<td><?php echo $cancelCreate['modifier_id']; ?></td>
			<td><?php echo $cancelCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cancels', 'action' => 'view', $cancelCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cancels', 'action' => 'edit', $cancelCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cancels', 'action' => 'delete', $cancelCreate['id']), null, __('Are you sure you want to delete # %s?', $cancelCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cancel Create'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Cancels'); ?></h3>
	<?php if (!empty($user['CancelModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Reason'); ?></th>
		<th><?php echo __('Replaced'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['CancelModify'] as $cancelModify): ?>
		<tr>
			<td><?php echo $cancelModify['id']; ?></td>
			<td><?php echo $cancelModify['attendee_id']; ?></td>
			<td><?php echo $cancelModify['conference_id']; ?></td>
			<td><?php echo $cancelModify['reason']; ?></td>
			<td><?php echo $cancelModify['replaced']; ?></td>
			<td><?php echo $cancelModify['comment']; ?></td>
			<td><?php echo $cancelModify['creator_id']; ?></td>
			<td><?php echo $cancelModify['created']; ?></td>
			<td><?php echo $cancelModify['modifier_id']; ?></td>
			<td><?php echo $cancelModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cancels', 'action' => 'view', $cancelModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cancels', 'action' => 'edit', $cancelModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cancels', 'action' => 'delete', $cancelModify['id']), null, __('Are you sure you want to delete # %s?', $cancelModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cancel Modify'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Emails'); ?></h3>
	<?php if (!empty($user['EmailCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['EmailCreate'] as $emailCreate): ?>
		<tr>
			<td><?php echo $emailCreate['id']; ?></td>
			<td><?php echo $emailCreate['name']; ?></td>
			<td><?php echo $emailCreate['description']; ?></td>
			<td><?php echo $emailCreate['subject']; ?></td>
			<td><?php echo $emailCreate['body']; ?></td>
			<td><?php echo $emailCreate['creator_id']; ?></td>
			<td><?php echo $emailCreate['created']; ?></td>
			<td><?php echo $emailCreate['modifier_id']; ?></td>
			<td><?php echo $emailCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'emails', 'action' => 'view', $emailCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'emails', 'action' => 'edit', $emailCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'emails', 'action' => 'delete', $emailCreate['id']), null, __('Are you sure you want to delete # %s?', $emailCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Email Create'), array('controller' => 'emails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Emails'); ?></h3>
	<?php if (!empty($user['EmailModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['EmailModify'] as $emailModify): ?>
		<tr>
			<td><?php echo $emailModify['id']; ?></td>
			<td><?php echo $emailModify['name']; ?></td>
			<td><?php echo $emailModify['description']; ?></td>
			<td><?php echo $emailModify['subject']; ?></td>
			<td><?php echo $emailModify['body']; ?></td>
			<td><?php echo $emailModify['creator_id']; ?></td>
			<td><?php echo $emailModify['created']; ?></td>
			<td><?php echo $emailModify['modifier_id']; ?></td>
			<td><?php echo $emailModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'emails', 'action' => 'view', $emailModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'emails', 'action' => 'edit', $emailModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'emails', 'action' => 'delete', $emailModify['id']), null, __('Are you sure you want to delete # %s?', $emailModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Email Modify'), array('controller' => 'emails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Finances'); ?></h3>
	<?php if (!empty($user['FinanceCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Receive Date'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Finance Type Id'); ?></th>
		<th><?php echo __('Count'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Charge'); ?></th>
		<th><?php echo __('Payment'); ?></th>
		<th><?php echo __('Balance'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['FinanceCreate'] as $financeCreate): ?>
		<tr>
			<td><?php echo $financeCreate['id']; ?></td>
			<td><?php echo $financeCreate['conference_id']; ?></td>
			<td><?php echo $financeCreate['receive_date']; ?></td>
			<td><?php echo $financeCreate['locality_id']; ?></td>
			<td><?php echo $financeCreate['finance_type_id']; ?></td>
			<td><?php echo $financeCreate['count']; ?></td>
			<td><?php echo $financeCreate['rate']; ?></td>
			<td><?php echo $financeCreate['charge']; ?></td>
			<td><?php echo $financeCreate['payment']; ?></td>
			<td><?php echo $financeCreate['balance']; ?></td>
			<td><?php echo $financeCreate['comment']; ?></td>
			<td><?php echo $financeCreate['creator_id']; ?></td>
			<td><?php echo $financeCreate['created']; ?></td>
			<td><?php echo $financeCreate['modifier_id']; ?></td>
			<td><?php echo $financeCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'finances', 'action' => 'view', $financeCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'finances', 'action' => 'edit', $financeCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'finances', 'action' => 'delete', $financeCreate['id']), null, __('Are you sure you want to delete # %s?', $financeCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Finance Create'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Finances'); ?></h3>
	<?php if (!empty($user['FinanceModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Receive Date'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Finance Type Id'); ?></th>
		<th><?php echo __('Count'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Charge'); ?></th>
		<th><?php echo __('Payment'); ?></th>
		<th><?php echo __('Balance'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['FinanceModify'] as $financeModify): ?>
		<tr>
			<td><?php echo $financeModify['id']; ?></td>
			<td><?php echo $financeModify['conference_id']; ?></td>
			<td><?php echo $financeModify['receive_date']; ?></td>
			<td><?php echo $financeModify['locality_id']; ?></td>
			<td><?php echo $financeModify['finance_type_id']; ?></td>
			<td><?php echo $financeModify['count']; ?></td>
			<td><?php echo $financeModify['rate']; ?></td>
			<td><?php echo $financeModify['charge']; ?></td>
			<td><?php echo $financeModify['payment']; ?></td>
			<td><?php echo $financeModify['balance']; ?></td>
			<td><?php echo $financeModify['comment']; ?></td>
			<td><?php echo $financeModify['creator_id']; ?></td>
			<td><?php echo $financeModify['created']; ?></td>
			<td><?php echo $financeModify['modifier_id']; ?></td>
			<td><?php echo $financeModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'finances', 'action' => 'view', $financeModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'finances', 'action' => 'edit', $financeModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'finances', 'action' => 'delete', $financeModify['id']), null, __('Are you sure you want to delete # %s?', $financeModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Finance Modify'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($user['PaymentCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Cash'); ?></th>
		<th><?php echo __('Check Number'); ?></th>
		<th><?php echo __('Check'); ?></th>
		<th><?php echo __('Locality Paid'); ?></th>
		<th><?php echo __('Bill Locality'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['PaymentCreate'] as $paymentCreate): ?>
		<tr>
			<td><?php echo $paymentCreate['id']; ?></td>
			<td><?php echo $paymentCreate['conference_id']; ?></td>
			<td><?php echo $paymentCreate['attendee_id']; ?></td>
			<td><?php echo $paymentCreate['locality_id']; ?></td>
			<td><?php echo $paymentCreate['cash']; ?></td>
			<td><?php echo $paymentCreate['check_number']; ?></td>
			<td><?php echo $paymentCreate['check']; ?></td>
			<td><?php echo $paymentCreate['locality_paid']; ?></td>
			<td><?php echo $paymentCreate['bill_locality']; ?></td>
			<td><?php echo $paymentCreate['comment']; ?></td>
			<td><?php echo $paymentCreate['creator_id']; ?></td>
			<td><?php echo $paymentCreate['created']; ?></td>
			<td><?php echo $paymentCreate['modifier_id']; ?></td>
			<td><?php echo $paymentCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'payments', 'action' => 'view', $paymentCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $paymentCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $paymentCreate['id']), null, __('Are you sure you want to delete # %s?', $paymentCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment Create'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($user['PaymentModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Cash'); ?></th>
		<th><?php echo __('Check Number'); ?></th>
		<th><?php echo __('Check'); ?></th>
		<th><?php echo __('Locality Paid'); ?></th>
		<th><?php echo __('Bill Locality'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['PaymentModify'] as $paymentModify): ?>
		<tr>
			<td><?php echo $paymentModify['id']; ?></td>
			<td><?php echo $paymentModify['conference_id']; ?></td>
			<td><?php echo $paymentModify['attendee_id']; ?></td>
			<td><?php echo $paymentModify['locality_id']; ?></td>
			<td><?php echo $paymentModify['cash']; ?></td>
			<td><?php echo $paymentModify['check_number']; ?></td>
			<td><?php echo $paymentModify['check']; ?></td>
			<td><?php echo $paymentModify['locality_paid']; ?></td>
			<td><?php echo $paymentModify['bill_locality']; ?></td>
			<td><?php echo $paymentModify['comment']; ?></td>
			<td><?php echo $paymentModify['creator_id']; ?></td>
			<td><?php echo $paymentModify['created']; ?></td>
			<td><?php echo $paymentModify['modifier_id']; ?></td>
			<td><?php echo $paymentModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'payments', 'action' => 'view', $paymentModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $paymentModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $paymentModify['id']), null, __('Are you sure you want to delete # %s?', $paymentModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment Modify'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Registration Steps'); ?></h3>
	<?php if (!empty($user['RegistrationStepCreate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Instructions Sent'); ?></th>
		<th><?php echo __('Receipt Confirmation'); ?></th>
		<th><?php echo __('Update Lrc'); ?></th>
		<th><?php echo __('First Reminder'); ?></th>
		<th><?php echo __('First Registrants Received'); ?></th>
		<th><?php echo __('First Check Registrations'); ?></th>
		<th><?php echo __('Lrc Asked Update'); ?></th>
		<th><?php echo __('Count By Rate'); ?></th>
		<th><?php echo __('Compose Reg Confirmation'); ?></th>
		<th><?php echo __('First Check Send'); ?></th>
		<th><?php echo __('First Update Finances'); ?></th>
		<th><?php echo __('Second Reminder'); ?></th>
		<th><?php echo __('Second Registrants Received'); ?></th>
		<th><?php echo __('Second Check Registrations'); ?></th>
		<th><?php echo __('Second Update Finances'); ?></th>
		<th><?php echo __('Compose Initial Summary'); ?></th>
		<th><?php echo __('Second Check Send'); ?></th>
		<th><?php echo __('Cc Bro Verify'); ?></th>
		<th><?php echo __('Cc Bro Sign'); ?></th>
		<th><?php echo __('Cc Sis Verify'); ?></th>
		<th><?php echo __('Cc Sis Sign'); ?></th>
		<th><?php echo __('Compose Final Summary'); ?></th>
		<th><?php echo __('Third Check Send'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['RegistrationStepCreate'] as $registrationStepCreate): ?>
		<tr>
			<td><?php echo $registrationStepCreate['id']; ?></td>
			<td><?php echo $registrationStepCreate['conference_id']; ?></td>
			<td><?php echo $registrationStepCreate['locality_id']; ?></td>
			<td><?php echo $registrationStepCreate['active']; ?></td>
			<td><?php echo $registrationStepCreate['user_id']; ?></td>
			<td><?php echo $registrationStepCreate['instructions_sent']; ?></td>
			<td><?php echo $registrationStepCreate['receipt_confirmation']; ?></td>
			<td><?php echo $registrationStepCreate['update_lrc']; ?></td>
			<td><?php echo $registrationStepCreate['first_reminder']; ?></td>
			<td><?php echo $registrationStepCreate['first_registrants_received']; ?></td>
			<td><?php echo $registrationStepCreate['first_check_registrations']; ?></td>
			<td><?php echo $registrationStepCreate['lrc_asked_update']; ?></td>
			<td><?php echo $registrationStepCreate['count_by_rate']; ?></td>
			<td><?php echo $registrationStepCreate['compose_reg_confirmation']; ?></td>
			<td><?php echo $registrationStepCreate['first_check_send']; ?></td>
			<td><?php echo $registrationStepCreate['first_update_finances']; ?></td>
			<td><?php echo $registrationStepCreate['second_reminder']; ?></td>
			<td><?php echo $registrationStepCreate['second_registrants_received']; ?></td>
			<td><?php echo $registrationStepCreate['second_check_registrations']; ?></td>
			<td><?php echo $registrationStepCreate['second_update_finances']; ?></td>
			<td><?php echo $registrationStepCreate['compose_initial_summary']; ?></td>
			<td><?php echo $registrationStepCreate['second_check_send']; ?></td>
			<td><?php echo $registrationStepCreate['cc_bro_verify']; ?></td>
			<td><?php echo $registrationStepCreate['cc_bro_sign']; ?></td>
			<td><?php echo $registrationStepCreate['cc_sis_verify']; ?></td>
			<td><?php echo $registrationStepCreate['cc_sis_sign']; ?></td>
			<td><?php echo $registrationStepCreate['compose_final_summary']; ?></td>
			<td><?php echo $registrationStepCreate['third_check_send']; ?></td>
			<td><?php echo $registrationStepCreate['creator_id']; ?></td>
			<td><?php echo $registrationStepCreate['created']; ?></td>
			<td><?php echo $registrationStepCreate['modifier_id']; ?></td>
			<td><?php echo $registrationStepCreate['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'registration_steps', 'action' => 'view', $registrationStepCreate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'registration_steps', 'action' => 'edit', $registrationStepCreate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'registration_steps', 'action' => 'delete', $registrationStepCreate['id']), null, __('Are you sure you want to delete # %s?', $registrationStepCreate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Registration Step Create'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Registration Steps'); ?></h3>
	<?php if (!empty($user['RegistrationStepModify'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Instructions Sent'); ?></th>
		<th><?php echo __('Receipt Confirmation'); ?></th>
		<th><?php echo __('Update Lrc'); ?></th>
		<th><?php echo __('First Reminder'); ?></th>
		<th><?php echo __('First Registrants Received'); ?></th>
		<th><?php echo __('First Check Registrations'); ?></th>
		<th><?php echo __('Lrc Asked Update'); ?></th>
		<th><?php echo __('Count By Rate'); ?></th>
		<th><?php echo __('Compose Reg Confirmation'); ?></th>
		<th><?php echo __('First Check Send'); ?></th>
		<th><?php echo __('First Update Finances'); ?></th>
		<th><?php echo __('Second Reminder'); ?></th>
		<th><?php echo __('Second Registrants Received'); ?></th>
		<th><?php echo __('Second Check Registrations'); ?></th>
		<th><?php echo __('Second Update Finances'); ?></th>
		<th><?php echo __('Compose Initial Summary'); ?></th>
		<th><?php echo __('Second Check Send'); ?></th>
		<th><?php echo __('Cc Bro Verify'); ?></th>
		<th><?php echo __('Cc Bro Sign'); ?></th>
		<th><?php echo __('Cc Sis Verify'); ?></th>
		<th><?php echo __('Cc Sis Sign'); ?></th>
		<th><?php echo __('Compose Final Summary'); ?></th>
		<th><?php echo __('Third Check Send'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['RegistrationStepModify'] as $registrationStepModify): ?>
		<tr>
			<td><?php echo $registrationStepModify['id']; ?></td>
			<td><?php echo $registrationStepModify['conference_id']; ?></td>
			<td><?php echo $registrationStepModify['locality_id']; ?></td>
			<td><?php echo $registrationStepModify['active']; ?></td>
			<td><?php echo $registrationStepModify['user_id']; ?></td>
			<td><?php echo $registrationStepModify['instructions_sent']; ?></td>
			<td><?php echo $registrationStepModify['receipt_confirmation']; ?></td>
			<td><?php echo $registrationStepModify['update_lrc']; ?></td>
			<td><?php echo $registrationStepModify['first_reminder']; ?></td>
			<td><?php echo $registrationStepModify['first_registrants_received']; ?></td>
			<td><?php echo $registrationStepModify['first_check_registrations']; ?></td>
			<td><?php echo $registrationStepModify['lrc_asked_update']; ?></td>
			<td><?php echo $registrationStepModify['count_by_rate']; ?></td>
			<td><?php echo $registrationStepModify['compose_reg_confirmation']; ?></td>
			<td><?php echo $registrationStepModify['first_check_send']; ?></td>
			<td><?php echo $registrationStepModify['first_update_finances']; ?></td>
			<td><?php echo $registrationStepModify['second_reminder']; ?></td>
			<td><?php echo $registrationStepModify['second_registrants_received']; ?></td>
			<td><?php echo $registrationStepModify['second_check_registrations']; ?></td>
			<td><?php echo $registrationStepModify['second_update_finances']; ?></td>
			<td><?php echo $registrationStepModify['compose_initial_summary']; ?></td>
			<td><?php echo $registrationStepModify['second_check_send']; ?></td>
			<td><?php echo $registrationStepModify['cc_bro_verify']; ?></td>
			<td><?php echo $registrationStepModify['cc_bro_sign']; ?></td>
			<td><?php echo $registrationStepModify['cc_sis_verify']; ?></td>
			<td><?php echo $registrationStepModify['cc_sis_sign']; ?></td>
			<td><?php echo $registrationStepModify['compose_final_summary']; ?></td>
			<td><?php echo $registrationStepModify['third_check_send']; ?></td>
			<td><?php echo $registrationStepModify['creator_id']; ?></td>
			<td><?php echo $registrationStepModify['created']; ?></td>
			<td><?php echo $registrationStepModify['modifier_id']; ?></td>
			<td><?php echo $registrationStepModify['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'registration_steps', 'action' => 'view', $registrationStepModify['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'registration_steps', 'action' => 'edit', $registrationStepModify['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'registration_steps', 'action' => 'delete', $registrationStepModify['id']), null, __('Are you sure you want to delete # %s?', $registrationStepModify['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Registration Step Modify'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
