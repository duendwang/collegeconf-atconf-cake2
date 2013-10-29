<div class="potentialAttendees view">
<h2><?php echo __('Potential Attendee'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($potentialAttendee['Conference']['name'], array('controller' => 'conferences', 'action' => 'view', $potentialAttendee['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($potentialAttendee['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $potentialAttendee['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Campus'); ?></dt>
		<dd>
			<?php echo $this->Html->link($potentialAttendee['Campus']['name'], array('controller' => 'campuses', 'action' => 'view', $potentialAttendee['Campus']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Allergies'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['allergies']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($potentialAttendee['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $potentialAttendee['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($potentialAttendee['PotentialAttendee']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Potential Attendee'), array('action' => 'edit', $potentialAttendee['PotentialAttendee']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Potential Attendee'), array('action' => 'delete', $potentialAttendee['PotentialAttendee']['id']), null, __('Are you sure you want to delete # %s?', $potentialAttendee['PotentialAttendee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Potential Attendees'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Potential Attendee'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>
