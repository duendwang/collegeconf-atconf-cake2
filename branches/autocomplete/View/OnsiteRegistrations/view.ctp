<div class="onsiteRegistrations view">
<h2><?php  echo __('Onsite Registration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($onsiteRegistration['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $onsiteRegistration['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($onsiteRegistration['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $onsiteRegistration['Attendee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registration'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['registration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cashier'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['cashier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hospitality'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['hospitality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Badge'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['badge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Need Cashier'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['need_cashier']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Need Hospitality'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['need_hospitality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Need Badge'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['need_badge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Need Old'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['need_old']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Old First'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['old_first']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Old Last'); ?></dt>
		<dd>
			<?php echo h($onsiteRegistration['OnsiteRegistration']['old_last']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Old Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($onsiteRegistration['OldLocality']['name'], array('controller' => 'localities', 'action' => 'view', $onsiteRegistration['OldLocality']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Onsite Registration'), array('action' => 'edit', $onsiteRegistration['OnsiteRegistration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Onsite Registration'), array('action' => 'delete', $onsiteRegistration['OnsiteRegistration']['id']), null, __('Are you sure you want to delete # %s?', $onsiteRegistration['OnsiteRegistration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Old Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
