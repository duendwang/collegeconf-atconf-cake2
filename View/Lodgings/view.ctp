<div class="lodgings view">
<h2><?php  echo __('Lodging'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lodging['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $lodging['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lodging['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $lodging['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Phone'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['home_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pet'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['pet']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capacity'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['capacity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['room']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($lodging['Lodging']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lodging'), array('action' => 'edit', $lodging['Lodging']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lodging'), array('action' => 'delete', $lodging['Lodging']['id']), null, __('Are you sure you want to delete # %s?', $lodging['Lodging']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>**/?>
<div class="related">
	<h3><?php echo __('Related Attendees'); ?></h3>
	<?php if (!empty($lodging['Attendee'])): ?>
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
		foreach ($lodging['Attendee'] as $attendee): ?>
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
</div>
