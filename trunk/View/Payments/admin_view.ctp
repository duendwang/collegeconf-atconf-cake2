<div class="payments view">
<h2><?php  echo __('Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $payment['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $payment['Attendee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $payment['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cash'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['cash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check Number'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['check_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Check'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality Paid'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['locality_paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bill Locality'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['bill_locality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Creator']['id'], array('controller' => 'users', 'action' => 'view', $payment['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($payment['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $payment['Modifier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($payment['Payment']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment'), array('action' => 'edit', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment'), array('action' => 'delete', $payment['Payment']['id']), null, __('Are you sure you want to delete # %s?', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
