<div class="cancels form">
<?php echo $this->Form->create('Cancel'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cancel'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('attendee_id');
		echo $this->Form->input('conference_id');
		echo $this->Form->input('reason');
		echo $this->Form->input('replaced');
		echo $this->Form->input('comment');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cancel.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cancel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
