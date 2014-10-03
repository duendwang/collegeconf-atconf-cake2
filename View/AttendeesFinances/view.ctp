<div class="attendeesFinances view">
<h2><?php  echo __('Attendees Finance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($attendeesFinance['AttendeesFinance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finance'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendeesFinance['Finance']['id'], array('controller' => 'finances', 'action' => 'view', $attendeesFinance['Finance']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Add'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendeesFinance['Add']['id'], array('controller' => 'attendees', 'action' => 'view', $attendeesFinance['Add']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cancel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attendeesFinance['Cancel']['id'], array('controller' => 'attendees', 'action' => 'view', $attendeesFinance['Cancel']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attendees Finance'), array('action' => 'edit', $attendeesFinance['AttendeesFinance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attendees Finance'), array('action' => 'delete', $attendeesFinance['AttendeesFinance']['id']), null, __('Are you sure you want to delete # %s?', $attendeesFinance['AttendeesFinance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendees Finance'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Add'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
