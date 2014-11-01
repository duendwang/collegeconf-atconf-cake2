<div class="attendees view">
    <h2><?php  echo __('Attendee'); ?></h2>
	<dl>
            <dt><?php echo __('Barcode'); ?></dt>
            <dd><?php echo h($attendee['Conference']['code'].$attendee['Attendee']['id']); ?>&nbsp;</dd>
            <dt><?php echo __('First Name'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['first_name']); ?>&nbsp;</dd>
            <dt><?php echo __('Last Name'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['last_name']); ?>&nbsp;</dd>
            <dt><?php echo __('Gender'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['gender']); ?>&nbsp;</dd>
            <dt><?php echo __('Locality'); ?></dt>
            <dd><?php echo h($attendee['Locality']['name']); ?>&nbsp;</dd>
            <dt><?php echo __('Campus'); ?></dt>
            <dd><?php echo h($attendee['Campus']['name']); ?>&nbsp;</dd>
            <dt><?php echo __('Conf Contact'); ?></dt>
            <dd><?php if($attendee['Attendee']['conf_contact'] == 1) echo 'X'; ?>&nbsp;</dd>
            <dt><?php echo __('New One'); ?></dt>
            <dd><?php if($attendee['Attendee']['new_one'] == 1) echo 'X'; ?>&nbsp;</dd>
            <dt><?php echo __('Group'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['group']); ?>&nbsp;</dd>
            <dt><?php echo __('Allergies'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['allergies']); ?>&nbsp;</dd>
            <dt><?php echo __('Status'); ?></dt>
            <dd><?php echo h($attendee['Status']['code']); ?>&nbsp;</dd>
            <dt><?php echo __('Cell Phone'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['cell_phone']); ?>&nbsp;</dd>
            <dt><?php echo __('Email'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['email']); ?>&nbsp;</dd>
            <dt><?php echo __('Lodging'); ?></dt>
            <dd><?php echo $this->Html->link($attendee['Lodging']['code'], array('controller' => 'lodgings', 'action' => 'view', $attendee['Attendee']['lodging_id'])); ?>&nbsp;</dd>
            <dt><?php echo __('Rate'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['rate']); ?>&nbsp;</dd>
            <dt><?php echo __('Paid At Conf'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['paid_at_conf']); ?>&nbsp;</dd>
            <dt><?php echo __('Comment'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['comment']); ?>&nbsp;</dd>
            <dt><?php echo __('Creator'); ?></dt>
            <dd><?php echo h($attendee['Creator']['username']); ?>&nbsp;</dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['created']); ?>&nbsp;</dd>
            <dt><?php echo __('Modifier'); ?></dt>
            <dd><?php echo h($attendee['Modifier']['username']); ?>&nbsp;</dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd><?php echo h($attendee['Attendee']['modified']); ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Attendee'), array('action' => 'edit', $attendee['Attendee']['id'])); ?> </li>
	<li><?php echo $this->Html->link(__('Check in Attendee'), array('controller' => 'check_ins', 'action' => 'add', $attendee['Attendee']['id'])); ?> </li>
	<li><?php echo $this->Html->link(__('Cancel Attendee'), array('controller' => 'cancels', 'action' => 'add', $attendee['Attendee']['id'])); ?> </li>
	<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add', $attendee['Attendee']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>

    </ul>
</div>
<div class="related">
    <h3><?php echo __('Checkins'); ?></h3>
    <h4>&emsp;&emsp;If this attendee has been checked in the pertinent information will display here.</h4>
	<?php if ($attendee['CheckIn']['id'] !== null) { ?>
            <dl>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd><?php echo $attendee['CheckIn']['timestamp']; ?>&nbsp;</dd>
            </dl>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Edit Check-in'), array('controller' => 'check_ins', 'action' => 'edit', $attendee['CheckIn']['id'])),
                        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $this->Form->postLink(__('Undo Check-in'), array('controller' => 'check_ins', 'action' => 'delete', $attendee['CheckIn']['id']), null, __('Are you sure you want to undo %s\'s checkin?', $attendee['Attendee']['name']));?></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Check in Attendee'), array('controller' => 'check_ins', 'action' => 'add', $attendee['Attendee']['id'])); ?></li>
                </ul>
            </div>
        <?php } ?>
</div>
<div class="related">
    <h3><?php echo __('Cancels'); ?></h3>
    <h4>&emsp;&emsp;If this attendee has been canceled the pertinent information will display here.</h4>
        <?php if ($attendee['Cancel']['id'] !== null) { ?>
            <dl>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
                    <?php if (!empty($attendee['AttendeeFinanceCancel'])) {
                        echo 'Excused: '.$attendee['Cancel']['reason'];
                    } else {
                        echo $attendee['Cancel']['reason'];
                    } ?>&nbsp;
                </dd>
		<dt><?php echo __('Replaced by'); ?></dt>
                <dd><?php echo $attendee['Cancel']['replaced']; ?>&nbsp;</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd><?php echo $attendee['Cancel']['comment']; ?>&nbsp;</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd><?php echo $attendee['Cancel']['creator_id']; ?>&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd><?php echo $attendee['Cancel']['created']; ?>&nbsp;</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd><?php echo $attendee['Cancel']['modifier_id']; ?>&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd><?php echo $attendee['Cancel']['modified']; ?>&nbsp;</dd>
            </dl>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Edit Cancellation'), array('controller' => 'cancels', 'action' => 'edit', $attendee['Cancel']['id'])),
                        '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                        $this->Form->postLink(__('Undo Cancellation'), array('controller' => 'cancels', 'action' => 'delete', $attendee['Cancel']['id']), null, __('Are you sure you want to undo %s\'s cancellation?', $attendee['Attendee']['name']));?></li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Cancel Attendee'), array('controller' => 'cancels', 'action' => 'add', $attendee['Attendee']['id'])); ?></li>
                </ul>
            </div>
        <?php } ?>
</div>
<div class="related">
    <h3><?php echo __('Payments'); ?></h3>
    <h4>&emsp;&emsp;If this attendee made any payments at the conference the information is displayed here.</h4>
	<?php if (!empty($attendee['Payment'])) { ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
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
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'payments', 'action' => 'edit', $payment['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'payments', 'action' => 'delete', $payment['id']), null, __('Are you sure you want to delete this payment?')); ?>
                    </td>
		</tr>
            <?php endforeach; ?>
            </table>
        <?php } ?>
        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add',$attendee['Attendee']['id'])); ?> </li>
            </ul>
        </div>
</div>
<div class="related">
    <h3><?php echo __('Related Finances'); ?></h3>
    <h4>&emsp;&emsp;Any related finances appear here. Click on the date to edit any finance.</h4>
        <?php if (!empty($related_finances)) { ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Receive Date'); ?></th>
                    <th><?php echo __('Description'); ?></th>
                    <th><?php echo __('Count'); ?></th>
                    <th><?php echo __('Rate'); ?></th>
                    <th><?php echo __('Charge'); ?></th>
                    <th><?php echo __('Payment'); ?></th>
                    <th><?php echo __('Balance'); ?></th>
                    <th><?php echo __('Comments'); ?></th>
                    <?php /**<th class="actions"><?php echo __('Actions'); ?></th>**/?>
                </tr>
            <?php
            $i = 0;
            foreach ($related_finances as $finance): ?>
		<tr>
                    <td><?php echo $this->Html->link($finance['Finance']['receive_date'],array('controller' => 'finances', 'action' => 'edit', $finance['Finance']['id'])); ?></td>
                    <td><?php echo $finance['FinanceType']['name']; ?></td>
                    <td><?php echo $finance['Finance']['count']; ?></td>
                    <td><?php echo $finance['Finance']['rate']; ?></td>
                    <td><?php echo $finance['Finance']['charge']; ?></td>
                    <td><?php echo $finance['Finance']['payment']; ?></td>
                    <td><?php echo $finance['Finance']['balance']; ?></td>
                    <td><?php echo $finance['Finance']['comment']; ?></td>
                    <?php /**<td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'attendees_finances', 'action' => 'view', $attendeeFinanceAdd['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'finances', 'action' => 'edit', $finance['Finance']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees_finances', 'action' => 'delete', $attendeeFinanceAdd['id']), null, __('Are you sure you want to delete # %s?', $attendeeFinanceAdd['id'])); ?>
                    </td>**/?>
		</tr>
            <?php endforeach; ?>
            </table>
        <?php } ?>
	<div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('View Locality Finances'), array('controller' => 'finances', 'action' => 'index', $attendee['Attendee']['locality_id'])); ?> </li>
            </ul>
        </div>
</div>
<div class="related">
    <h3><?php echo __('Related Onsite Registrations'); ?></h3>
    <h4>&emsp;&emsp;If this attendee registered on-site at the conference the progress of the registration process is displayed here.</h4>
        <?php if ($attendee['OnsiteRegistration']['id'] !== null) { ?>
            <dl>
                <dt><?php echo __('Completed Registration'); ?></dt>
                <dd><?php if ($attendee['OnsiteRegistration']['registration'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Need Cashier'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['need_cashier'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Paid at Cashier'); ?></dt>
                <dd><?php if ($attendee['OnsiteRegistration']['cashier'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Need Hospitality'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['need_hospitality'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Received Hospitality Assignment'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['hospitality'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Need Badge'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['need_badge'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Received Badge'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['badge'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Need Old Attendee Packet'); ?></dt>
		<dd><?php if ($attendee['OnsiteRegistration']['need_old'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Replaced Attendee Name'); ?></dt>
		<dd><?php echo $attendee['OnsiteRegistration']['old_first'].' '.$attendee['OnsiteRegistration']['old_last']; ?>&nbsp;</dd>
		<dt><?php echo __('Replaced Attendee Locality ID'); ?></dt>
		<dd><?php echo $this->Html->link($attendee['OnsiteRegistration']['old_locality_id'],array('controller' => 'localities','action' => 'view',$attendee['OnsiteRegistration']['old_locality_id'])); ?>&nbsp;</dd>
            </dl>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Edit Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'edit', $attendee['OnsiteRegistration']['id'])); ?></li>
                </ul>
            </div>
        <?php } ?>
</div>
<div class="related">
    <h3><?php echo __('Related Part Time Registrations'); ?></h3>
    <h4>&emsp;&emsp;If this attendee part time for the conference the pertinent information is displayed here.</h4>
	<?php if ($attendee['PartTimeRegistration']['id'] !== null) { ?>
            <dl>
		<dt><?php echo __('Friday Dinner'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['fri_din'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Friday Night Meeting'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['fri_mtg'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Friday Night Lodging'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['fri_hosp'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Breakfast'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_bkfst'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Morning Meeting'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_mtg1'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Lunch'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_lun'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Afternoon Meeting'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_mtg2'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Dinner'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_din'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Night Meeting'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_mtg3'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('Saturday Night Lodging'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['sat_hosp'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('LD Breakfast'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['ld_bkfst'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('LD Morning Meeting'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['ld_mtg'] == 1) echo 'X'; ?>&nbsp;</dd>
		<dt><?php echo __('LD Lunch'); ?></dt>
		<dd><?php if ($attendee['PartTimeRegistration']['ld_lun'] == 1) echo 'X'; ?>&nbsp;</dd>
            </dl>
            <div class="actions">
                <ul>
                    <li><?php echo $this->Html->link(__('Edit PT Registration'), array('controller' => 'part_time_registrations', 'action' => 'edit', $attendee['PartTimeRegistration']['id'])); ?></li>
                </ul>
            </div>
        <?php } ?>
</div>