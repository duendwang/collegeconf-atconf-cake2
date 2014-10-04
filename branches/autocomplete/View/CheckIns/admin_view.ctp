<div class="checkIns view">
<h2><?php  echo __('Check In'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($checkIn['CheckIn']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($checkIn['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $checkIn['Attendee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($checkIn['CheckIn']['timestamp']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Check In'), array('action' => 'edit', $checkIn['CheckIn']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Check In'), array('action' => 'delete', $checkIn['CheckIn']['id']), null, __('Are you sure you want to delete # %s?', $checkIn['CheckIn']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
