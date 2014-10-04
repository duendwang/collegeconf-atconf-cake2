<div class="lodgingFacilities form">
<?php echo $this->Form->create('LodgingFacility'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lodging Facility'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('conference_location_id');
		echo $this->Form->input('code');
		echo $this->Form->input('location');
		echo $this->Form->input('room');
		echo $this->Form->input('accomodations');
		echo $this->Form->input('capacity');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('phone');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('LodgingFacility.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LodgingFacility.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Lodging Facilities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
