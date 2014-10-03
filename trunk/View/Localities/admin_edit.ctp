<div class="localities form">
<?php echo $this->Form->create('Locality'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Locality'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
                echo $this->Form->input('preferred_conference');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Locality.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Locality.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Localities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lrcs'), array('controller' => 'lrcs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lrc'), array('controller' => 'lrcs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Registration Steps'), array('controller' => 'registration_steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Registration Step'), array('controller' => 'registration_steps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
