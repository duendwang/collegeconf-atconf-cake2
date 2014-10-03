<div class="attendees view">
<h2><?php  echo __('Attendee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $attendee['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $attendee['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Campus'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Campus']['name'], array('controller' => 'campuses', 'action' => 'view', $attendee['Campus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lrc'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['lrc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conf Contact'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['conf_contact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('New One'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['new_one']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['group']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allergies'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['allergies']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $attendee['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City State'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['city_state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lodging'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Lodging']['name'], array('controller' => 'lodgings', 'action' => 'view', $attendee['Lodging']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Submitter'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['submitter']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid At Conf'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['paid_at_conf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amt Paid'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['amt_paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Num'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['check_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid Date'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['paid_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Creator']['id'], array('controller' => 'users', 'action' => 'view', $attendee['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendee['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $attendee['Modifier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($attendee['Attendee']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attendee'), array('action' => 'edit', $attendee['Attendee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attendee'), array('action' => 'delete', $attendee['Attendee']['id']), null, __('Are you sure you want to delete # %s?', $attendee['Attendee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('controller' => 'attendees_finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee Finance Add'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Cancels'); ?></h3>
	<?php if (!empty($attendee['Cancel'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Attendee Id'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['attendee_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Conference Id'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['conference_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['reason']; ?>
&nbsp;</dd>
		<dt><?php echo __('Replaced'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['replaced']; ?>
&nbsp;</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['comment']; ?>
&nbsp;</dd>
		<dt><?php echo __('Creator Id'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['creator_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modifier Id'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['modifier_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $attendee['Cancel']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Cancel'), array('controller' => 'cancels', 'action' => 'edit', $attendee['Cancel']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Check Ins'); ?></h3>
	<?php if (!empty($attendee['CheckIn'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $attendee['CheckIn']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Attendee Id'); ?></dt>
		<dd>
	<?php echo $attendee['CheckIn']['attendee_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
	<?php echo $attendee['CheckIn']['timestamp']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Check In'), array('controller' => 'check_ins', 'action' => 'edit', $attendee['CheckIn']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Onsite Registrations'); ?></h3>
	<?php if (!empty($attendee['OnsiteRegistration'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Conference Id'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['conference_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Attendee Id'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['attendee_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Registration'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['registration']; ?>
&nbsp;</dd>
		<dt><?php echo __('Cashier'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['cashier']; ?>
&nbsp;</dd>
		<dt><?php echo __('Hospitality'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['hospitality']; ?>
&nbsp;</dd>
		<dt><?php echo __('Badge'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['badge']; ?>
&nbsp;</dd>
		<dt><?php echo __('Need Cashier'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['need_cashier']; ?>
&nbsp;</dd>
		<dt><?php echo __('Need Hospitality'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['need_hospitality']; ?>
&nbsp;</dd>
		<dt><?php echo __('Need Badge'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['need_badge']; ?>
&nbsp;</dd>
		<dt><?php echo __('Need Old'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['need_old']; ?>
&nbsp;</dd>
		<dt><?php echo __('Old First'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['old_first']; ?>
&nbsp;</dd>
		<dt><?php echo __('Old Last'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['old_last']; ?>
&nbsp;</dd>
		<dt><?php echo __('Old Locality Id'); ?></dt>
		<dd>
	<?php echo $attendee['OnsiteRegistration']['old_locality_id']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'edit', $attendee['OnsiteRegistration']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Part Time Registrations'); ?></h3>
	<?php if (!empty($attendee['PartTimeRegistration'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Conference Id'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['conference_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Attendee Id'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['attendee_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Fri Din'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['fri_din']; ?>
&nbsp;</dd>
		<dt><?php echo __('Fri Mtg'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['fri_mtg']; ?>
&nbsp;</dd>
		<dt><?php echo __('Fri Hosp'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['fri_hosp']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Bkfst'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_bkfst']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Mtg1'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_mtg1']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Lun'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_lun']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Mtg2'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_mtg2']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Din'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_din']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Mtg3'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_mtg3']; ?>
&nbsp;</dd>
		<dt><?php echo __('Sat Hosp'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['sat_hosp']; ?>
&nbsp;</dd>
		<dt><?php echo __('Ld Bkfst'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['ld_bkfst']; ?>
&nbsp;</dd>
		<dt><?php echo __('Ld Mtg'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['ld_mtg']; ?>
&nbsp;</dd>
		<dt><?php echo __('Ld Lun'); ?></dt>
		<dd>
	<?php echo $attendee['PartTimeRegistration']['ld_lun']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'edit', $attendee['PartTimeRegistration']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($attendee['Payment'])): ?>
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
		foreach ($attendee['Payment'] as $payment): ?>
		<tr>
			<td><?php echo $payment['id']; ?></td>
			<td><?php echo $payment['conference_id']; ?></td>
			<td><?php echo $payment['attendee_id']; ?></td>
			<td><?php echo $payment['locality_id']; ?></td>
			<td><?php echo $payment['cash']; ?></td>
			<td><?php echo $payment['check_number']; ?></td>
			<td><?php echo $payment['check']; ?></td>
			<td><?php echo $payment['locality_paid']; ?></td>
			<td><?php echo $payment['bill_locality']; ?></td>
			<td><?php echo $payment['comment']; ?></td>
			<td><?php echo $payment['creator_id']; ?></td>
			<td><?php echo $payment['created']; ?></td>
			<td><?php echo $payment['modifier_id']; ?></td>
			<td><?php echo $payment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'payments', 'action' => 'view', $payment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $payment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $payment['id']), null, __('Are you sure you want to delete # %s?', $payment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees Finances'); ?></h3>
	<?php if (!empty($attendee['AttendeeFinanceAdd'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Finance Id'); ?></th>
		<th><?php echo __('Add Attendee Id'); ?></th>
		<th><?php echo __('Cancel Attendee Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attendee['AttendeeFinanceAdd'] as $attendeeFinanceAdd): ?>
		<tr>
			<td><?php echo $attendeeFinanceAdd['id']; ?></td>
			<td><?php echo $attendeeFinanceAdd['finance_id']; ?></td>
			<td><?php echo $attendeeFinanceAdd['add_attendee_id']; ?></td>
			<td><?php echo $attendeeFinanceAdd['cancel_attendee_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees_finances', 'action' => 'view', $attendeeFinanceAdd['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees_finances', 'action' => 'edit', $attendeeFinanceAdd['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees_finances', 'action' => 'delete', $attendeeFinanceAdd['id']), null, __('Are you sure you want to delete # %s?', $attendeeFinanceAdd['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attendee Finance Add'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees Finances'); ?></h3>
	<?php if (!empty($attendee['AttendeeFinanceCancel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Finance Id'); ?></th>
		<th><?php echo __('Add Attendee Id'); ?></th>
		<th><?php echo __('Cancel Attendee Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($attendee['AttendeeFinanceCancel'] as $attendeeFinanceCancel): ?>
		<tr>
			<td><?php echo $attendeeFinanceCancel['id']; ?></td>
			<td><?php echo $attendeeFinanceCancel['finance_id']; ?></td>
			<td><?php echo $attendeeFinanceCancel['add_attendee_id']; ?></td>
			<td><?php echo $attendeeFinanceCancel['cancel_attendee_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees_finances', 'action' => 'view', $attendeeFinanceCancel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees_finances', 'action' => 'edit', $attendeeFinanceCancel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees_finances', 'action' => 'delete', $attendeeFinanceCancel['id']), null, __('Are you sure you want to delete # %s?', $attendeeFinanceCancel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attendee Finance Cancel'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
