<div class="finances view">
<h2><?php  echo __('Finance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($finance['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $finance['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receive Date'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['receive_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($finance['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $finance['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finance Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($finance['FinanceType']['name'], array('controller' => 'finance_types', 'action' => 'view', $finance['FinanceType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Count'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Charge'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['charge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['payment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Balance'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($finance['Creator']['id'], array('controller' => 'users', 'action' => 'view', $finance['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($finance['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $finance['Modifier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($finance['Finance']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Finance'), array('action' => 'edit', $finance['Finance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Finance'), array('action' => 'delete', $finance['Finance']['id']), null, __('Are you sure you want to delete # %s?', $finance['Finance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finance Types'), array('controller' => 'finance_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Type'), array('controller' => 'finance_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('controller' => 'attendees_finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Attendee'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Attendees Finances'); ?></h3>
	<?php if (!empty($finance['FinanceAttendee'])): ?>
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
		foreach ($finance['FinanceAttendee'] as $financeAttendee): ?>
		<tr>
			<td><?php echo $financeAttendee['id']; ?></td>
			<td><?php echo $financeAttendee['finance_id']; ?></td>
			<td><?php echo $financeAttendee['add_attendee_id']; ?></td>
			<td><?php echo $financeAttendee['cancel_attendee_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attendees_finances', 'action' => 'view', $financeAttendee['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attendees_finances', 'action' => 'edit', $financeAttendee['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attendees_finances', 'action' => 'delete', $financeAttendee['id']), null, __('Are you sure you want to delete # %s?', $financeAttendee['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Finance Attendee'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
