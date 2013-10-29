<div class="partTimeRegistrations view">
<h2><?php  echo __('Part Time Registration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($partTimeRegistration['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $partTimeRegistration['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($partTimeRegistration['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $partTimeRegistration['Attendee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fri Din'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['fri_din']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fri Mtg'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['fri_mtg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fri Hosp'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['fri_hosp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Bkfst'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_bkfst']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Mtg1'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Lun'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_lun']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Mtg2'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Din'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_din']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Mtg3'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_mtg3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sat Hosp'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['sat_hosp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ld Bkfst'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['ld_bkfst']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ld Mtg'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['ld_mtg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ld Lun'); ?></dt>
		<dd>
			<?php echo h($partTimeRegistration['PartTimeRegistration']['ld_lun']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Part Time Registration'), array('action' => 'edit', $partTimeRegistration['PartTimeRegistration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Part Time Registration'), array('action' => 'delete', $partTimeRegistration['PartTimeRegistration']['id']), null, __('Are you sure you want to delete # %s?', $partTimeRegistration['PartTimeRegistration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
