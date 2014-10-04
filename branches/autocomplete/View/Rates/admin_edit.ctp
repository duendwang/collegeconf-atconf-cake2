<div class="rates form">
<?php echo $this->Form->create('Rate'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Rate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conference_location_id');
		echo $this->Form->input('rate_type_id');
		echo $this->Form->input('cost');
		echo $this->Form->input('latefee_applies');
		echo $this->Form->input('active');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Rate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Types'), array('controller' => 'rate_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Type'), array('controller' => 'rate_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
