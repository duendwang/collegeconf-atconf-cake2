<div class="weekdays form">
<?php echo $this->Form->create('Weekday'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Weekday'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Weekday.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Weekday.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Weekdays'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('controller' => 'conference_deadlines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
	</ul>
</div>
