<div class="lodgings form">
<?php echo $this->Form->create('Lodging'); ?>
	<fieldset>
		<legend><?php echo __('Add Lodging'); ?></legend>
	<?php
		echo $this->Form->input('conference_id');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('home_phone');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('pet');
		echo $this->Form->input('gender');
		echo $this->Form->input('capacity');
		echo $this->Form->input('room');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lodgings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
