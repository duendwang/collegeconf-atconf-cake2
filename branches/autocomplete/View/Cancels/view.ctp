<div class="cancels view">
<h2><?php  echo __('Cancel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attendee'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cancel['Attendee']['id'], array('controller' => 'attendees', 'action' => 'view', $cancel['Attendee']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cancel['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $cancel['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Replaced'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['replaced']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creator'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cancel['Creator']['id'], array('controller' => 'users', 'action' => 'view', $cancel['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cancel['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $cancel['Modifier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cancel['Cancel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cancel'), array('action' => 'edit', $cancel['Cancel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cancel'), array('action' => 'delete', $cancel['Cancel']['id']), null, __('Are you sure you want to delete # %s?', $cancel['Cancel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
