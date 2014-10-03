<div class="content">
	<h2><?php echo __('No-show Attendees'); ?></h2><br>
        <p>In <a href="http://192.168.5.2/phpmyadmin">phpmyadmin</a>, export the attendees, checkins, and localities tables as an Excel file.</p>
        <p>Open the exported file.</p>
        <p>Rename the attendees, checkins, and localities sheets to 'attendees', 'checkins', and 'localities' respectively.</p>
        <p>Create a new Locality column to the right of locality_id and perform a vlookup to display the locality name (=vlookup(xx,localities!A:B,2,false))</p>
        <p>Sort the checkin table by attendee_id in ascending order.</p>
        <p>Create a new Check In column to the right of all the data and perform a vlookup to display check-in information (=vlookup(xx.checkins!B:C,2,false))</p>
        <p>Filter out or delete all attendees that have an entry in the Check In column.</p>
        <p>Further filter out or delete any attendees who were replaced by another as indicated in the comment column.</p>
        <p>Hide the necessary columns so that only the barcode, locality, first and last name, gender, and rate fields are displayed.</p>
        <p>To the far right, add a Comments column. This is different from the original comment column that should be hidden.</p>
        <p>Add an appropriate page header and format the document so that it displays properly on one page. Print the document as necessary.</p>
<?php /**        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('barcode'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('campus_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lrc'); ?></th>
			<th><?php echo $this->Paginator->sort('conf_contact'); ?></th>
			<th><?php echo $this->Paginator->sort('new_one'); ?></th>
			<th><?php echo $this->Paginator->sort('group'); ?></th>
			<th><?php echo $this->Paginator->sort('allergies'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('city_state'); ?></th>
			<th><?php echo $this->Paginator->sort('host_name'); ?></th>
			<th><?php echo $this->Paginator->sort('host_address'); ?></th>
			<th><?php echo $this->Paginator->sort('host_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('lodging_id'); ?></th>
			<th><?php echo $this->Paginator->sort('add'); ?></th>
			<th><?php echo $this->Paginator->sort('submitter'); ?></th>
			<th><?php echo $this->Paginator->sort('PT'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_at_conf'); ?></th>
			<th><?php echo $this->Paginator->sort('cancel'); ?></th>
			<th><?php echo $this->Paginator->sort('cancel_reason'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<?php /**<th><?php echo $this->Paginator->sort('amt_paid'); ?></th>
			<th><?php echo $this->Paginator->sort('check_num'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_date'); ?></th>**/?>
<?php /**			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($attendees as $attendee): ?>
	<tr>
		<td><?php echo h($attendee['Attendee']['id']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['barcode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $attendee['Conference']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->link($attendee['Attendee']['first_name'], array('action' => 'edit', $attendee['Attendee']['id']));?>

                </td>
                <td>
                    <?php echo $this->Html->link($attendee['Attendee']['last_name'], array('action' => 'edit', $attendee['Attendee']['id']));?></td>
		<td><?php echo h($attendee['Attendee']['gender']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Locality']['id'], array('controller' => 'localities', 'action' => 'view', $attendee['Locality']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attendee['Campus']['name'], array('controller' => 'campuses', 'action' => 'view', $attendee['Campus']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['lrc']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['conf_contact']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['new_one']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['group']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['allergies']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $attendee['Status']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['email']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['city_state']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_name']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_address']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_phone']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Lodging']['name'], array('controller' => 'lodgings', 'action' => 'view', $attendee['Lodging']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['add']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['submitter']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['PT']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['rate']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_at_conf']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['cancel']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['cancel_reason']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['comment']); ?>&nbsp;</td>
		<?php /**<td><?php echo h($attendee['Attendee']['amt_paid']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['check_num']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_date']); ?>&nbsp;</td>**/?>
<?php /**		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attendee['Attendee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attendee['Attendee']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attendee['Attendee']['id']), null, __('Are you sure you want to delete # %s?', $attendee['Attendee']['id'])); ?>
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
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Attendee'), array('action' => 'add')); ?></li>
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
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
	</ul>
</div>
**/?>