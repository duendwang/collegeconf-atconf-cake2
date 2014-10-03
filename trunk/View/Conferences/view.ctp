<div class="conferences view">
<h2><?php  echo __('Conference'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Term'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['term']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Part'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['part']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($conference['ConferenceLocation']['name'], array('controller' => 'conference_locations', 'action' => 'view', $conference['ConferenceLocation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($conference['Conference']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Conference'), array('action' => 'edit', $conference['Conference']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Conference'), array('action' => 'delete', $conference['Conference']['id']), null, __('Are you sure you want to delete # %s?', $conference['Conference']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('controller' => 'conference_deadline_exceptions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('controller' => 'registration_steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees'); ?></h3>
	<?php if (!empty($conference['Attendee'])): ?>
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
		foreach ($conference['Attendee'] as $attendee): ?>
		<tr>
			<td><?php echo $attendee['id']; ?></td>
			<td><?php echo $attendee['conference_id']; ?></td>
			<td><?php echo $attendee['first_name']; ?></td>
			<td><?php echo $attendee['last_name']; ?></td>
			<td><?php echo $attendee['gender']; ?></td>
			<td><?php echo $attendee['locality_id']; ?></td>
			<td><?php echo $attendee['campus_id']; ?></td>
			<td><?php echo $attendee['lrc']; ?></td>
			<td><?php echo $attendee['conf_contact']; ?></td>
			<td><?php echo $attendee['new_one']; ?></td>
			<td><?php echo $attendee['group']; ?></td>
			<td><?php echo $attendee['allergies']; ?></td>
			<td><?php echo $attendee['status_id']; ?></td>
			<td><?php echo $attendee['cell_phone']; ?></td>
			<td><?php echo $attendee['email']; ?></td>
			<td><?php echo $attendee['city_state']; ?></td>
			<td><?php echo $attendee['lodging_id']; ?></td>
			<td><?php echo $attendee['submitter']; ?></td>
			<td><?php echo $attendee['rate']; ?></td>
			<td><?php echo $attendee['paid_at_conf']; ?></td>
			<td><?php echo $attendee['comment']; ?></td>
			<td><?php echo $attendee['amt_paid']; ?></td>
			<td><?php echo $attendee['check_num']; ?></td>
			<td><?php echo $attendee['paid_date']; ?></td>
			<td><?php echo $attendee['creator_id']; ?></td>
			<td><?php echo $attendee['created']; ?></td>
			<td><?php echo $attendee['modifier_id']; ?></td>
			<td><?php echo $attendee['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees', 'action' => 'view', $attendee['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees', 'action' => 'edit', $attendee['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees', 'action' => 'delete', $attendee['id']), null, __('Are you sure you want to delete # %s?', $attendee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Cancels'); ?></h3>
	<?php if (!empty($conference['Cancel'])): ?>
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
		foreach ($conference['Cancel'] as $cancel): ?>
		<tr>
			<td><?php echo $cancel['id']; ?></td>
			<td><?php echo $cancel['attendee_id']; ?></td>
			<td><?php echo $cancel['conference_id']; ?></td>
			<td><?php echo $cancel['reason']; ?></td>
			<td><?php echo $cancel['replaced']; ?></td>
			<td><?php echo $cancel['comment']; ?></td>
			<td><?php echo $cancel['creator_id']; ?></td>
			<td><?php echo $cancel['created']; ?></td>
			<td><?php echo $cancel['modifier_id']; ?></td>
			<td><?php echo $cancel['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cancels', 'action' => 'view', $cancel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cancels', 'action' => 'edit', $cancel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cancels', 'action' => 'delete', $cancel['id']), null, __('Are you sure you want to delete # %s?', $cancel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Conference Deadline Exceptions'); ?></h3>
	<?php if (!empty($conference['ConferenceDeadlineException'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Conference Deadline Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conference['ConferenceDeadlineException'] as $conferenceDeadlineException): ?>
		<tr>
			<td><?php echo $conferenceDeadlineException['id']; ?></td>
			<td><?php echo $conferenceDeadlineException['conference_id']; ?></td>
			<td><?php echo $conferenceDeadlineException['conference_deadline_id']; ?></td>
			<td><?php echo $conferenceDeadlineException['date']; ?></td>
			<td><?php echo $conferenceDeadlineException['time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'conference_deadline_exceptions', 'action' => 'view', $conferenceDeadlineException['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'conference_deadline_exceptions', 'action' => 'edit', $conferenceDeadlineException['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'conference_deadline_exceptions', 'action' => 'delete', $conferenceDeadlineException['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadlineException['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('controller' => 'conference_deadline_exceptions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Finances'); ?></h3>
	<?php if (!empty($conference['Finance'])): ?>
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
		foreach ($conference['Finance'] as $finance): ?>
		<tr>
			<td><?php echo $finance['id']; ?></td>
			<td><?php echo $finance['conference_id']; ?></td>
			<td><?php echo $finance['receive_date']; ?></td>
			<td><?php echo $finance['locality_id']; ?></td>
			<td><?php echo $finance['finance_type_id']; ?></td>
			<td><?php echo $finance['count']; ?></td>
			<td><?php echo $finance['rate']; ?></td>
			<td><?php echo $finance['charge']; ?></td>
			<td><?php echo $finance['payment']; ?></td>
			<td><?php echo $finance['balance']; ?></td>
			<td><?php echo $finance['comment']; ?></td>
			<td><?php echo $finance['creator_id']; ?></td>
			<td><?php echo $finance['created']; ?></td>
			<td><?php echo $finance['modifier_id']; ?></td>
			<td><?php echo $finance['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'finances', 'action' => 'view', $finance['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'finances', 'action' => 'edit', $finance['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'finances', 'action' => 'delete', $finance['id']), null, __('Are you sure you want to delete # %s?', $finance['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Lodgings'); ?></h3>
	<?php if (!empty($conference['Lodging'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Home Phone'); ?></th>
		<th><?php echo __('Cell Phone'); ?></th>
		<th><?php echo __('Pet'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Capacity'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conference['Lodging'] as $lodging): ?>
		<tr>
			<td><?php echo $lodging['id']; ?></td>
			<td><?php echo $lodging['conference_id']; ?></td>
			<td><?php echo $lodging['locality_id']; ?></td>
			<td><?php echo $lodging['code']; ?></td>
			<td><?php echo $lodging['name']; ?></td>
			<td><?php echo $lodging['address']; ?></td>
			<td><?php echo $lodging['city']; ?></td>
			<td><?php echo $lodging['zip']; ?></td>
			<td><?php echo $lodging['home_phone']; ?></td>
			<td><?php echo $lodging['cell_phone']; ?></td>
			<td><?php echo $lodging['pet']; ?></td>
			<td><?php echo $lodging['gender']; ?></td>
			<td><?php echo $lodging['capacity']; ?></td>
			<td><?php echo $lodging['room']; ?></td>
			<td><?php echo $lodging['comment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'lodgings', 'action' => 'view', $lodging['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lodgings', 'action' => 'edit', $lodging['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lodgings', 'action' => 'delete', $lodging['id']), null, __('Are you sure you want to delete # %s?', $lodging['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Onsite Registrations'); ?></h3>
	<?php if (!empty($conference['OnsiteRegistration'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Registration'); ?></th>
		<th><?php echo __('Cashier'); ?></th>
		<th><?php echo __('Hospitality'); ?></th>
		<th><?php echo __('Badge'); ?></th>
		<th><?php echo __('Need Cashier'); ?></th>
		<th><?php echo __('Need Hospitality'); ?></th>
		<th><?php echo __('Need Badge'); ?></th>
		<th><?php echo __('Need Old'); ?></th>
		<th><?php echo __('Old First'); ?></th>
		<th><?php echo __('Old Last'); ?></th>
		<th><?php echo __('Old Locality Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conference['OnsiteRegistration'] as $onsiteRegistration): ?>
		<tr>
			<td><?php echo $onsiteRegistration['id']; ?></td>
			<td><?php echo $onsiteRegistration['conference_id']; ?></td>
			<td><?php echo $onsiteRegistration['attendee_id']; ?></td>
			<td><?php echo $onsiteRegistration['registration']; ?></td>
			<td><?php echo $onsiteRegistration['cashier']; ?></td>
			<td><?php echo $onsiteRegistration['hospitality']; ?></td>
			<td><?php echo $onsiteRegistration['badge']; ?></td>
			<td><?php echo $onsiteRegistration['need_cashier']; ?></td>
			<td><?php echo $onsiteRegistration['need_hospitality']; ?></td>
			<td><?php echo $onsiteRegistration['need_badge']; ?></td>
			<td><?php echo $onsiteRegistration['need_old']; ?></td>
			<td><?php echo $onsiteRegistration['old_first']; ?></td>
			<td><?php echo $onsiteRegistration['old_last']; ?></td>
			<td><?php echo $onsiteRegistration['old_locality_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'onsite_registrations', 'action' => 'view', $onsiteRegistration['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'onsite_registrations', 'action' => 'edit', $onsiteRegistration['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'onsite_registrations', 'action' => 'delete', $onsiteRegistration['id']), null, __('Are you sure you want to delete # %s?', $onsiteRegistration['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Part Time Registrations'); ?></h3>
	<?php if (!empty($conference['PartTimeRegistration'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Attendee Id'); ?></th>
		<th><?php echo __('Fri Din'); ?></th>
		<th><?php echo __('Fri Mtg'); ?></th>
		<th><?php echo __('Fri Hosp'); ?></th>
		<th><?php echo __('Sat Bkfst'); ?></th>
		<th><?php echo __('Sat Mtg1'); ?></th>
		<th><?php echo __('Sat Lun'); ?></th>
		<th><?php echo __('Sat Mtg2'); ?></th>
		<th><?php echo __('Sat Din'); ?></th>
		<th><?php echo __('Sat Mtg3'); ?></th>
		<th><?php echo __('Sat Hosp'); ?></th>
		<th><?php echo __('Ld Bkfst'); ?></th>
		<th><?php echo __('Ld Mtg'); ?></th>
		<th><?php echo __('Ld Lun'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conference['PartTimeRegistration'] as $partTimeRegistration): ?>
		<tr>
			<td><?php echo $partTimeRegistration['id']; ?></td>
			<td><?php echo $partTimeRegistration['conference_id']; ?></td>
			<td><?php echo $partTimeRegistration['attendee_id']; ?></td>
			<td><?php echo $partTimeRegistration['fri_din']; ?></td>
			<td><?php echo $partTimeRegistration['fri_mtg']; ?></td>
			<td><?php echo $partTimeRegistration['fri_hosp']; ?></td>
			<td><?php echo $partTimeRegistration['sat_bkfst']; ?></td>
			<td><?php echo $partTimeRegistration['sat_mtg1']; ?></td>
			<td><?php echo $partTimeRegistration['sat_lun']; ?></td>
			<td><?php echo $partTimeRegistration['sat_mtg2']; ?></td>
			<td><?php echo $partTimeRegistration['sat_din']; ?></td>
			<td><?php echo $partTimeRegistration['sat_mtg3']; ?></td>
			<td><?php echo $partTimeRegistration['sat_hosp']; ?></td>
			<td><?php echo $partTimeRegistration['ld_bkfst']; ?></td>
			<td><?php echo $partTimeRegistration['ld_mtg']; ?></td>
			<td><?php echo $partTimeRegistration['ld_lun']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'part_time_registrations', 'action' => 'view', $partTimeRegistration['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'part_time_registrations', 'action' => 'edit', $partTimeRegistration['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'part_time_registrations', 'action' => 'delete', $partTimeRegistration['id']), null, __('Are you sure you want to delete # %s?', $partTimeRegistration['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Payments'); ?></h3>
	<?php if (!empty($conference['Payment'])): ?>
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
		foreach ($conference['Payment'] as $payment): ?>
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
	<h3><?php echo __('Related Registration Steps'); ?></h3>
	<?php if (!empty($conference['RegistrationStep'])): ?>
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
		foreach ($conference['RegistrationStep'] as $registrationStep): ?>
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
