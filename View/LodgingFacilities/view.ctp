<div class="lodgingFacilities view">
<h2><?php  echo __('Lodging Facility'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lodgingFacility['ConferenceLocation']['name'], array('controller' => 'conference_locations', 'action' => 'view', $lodgingFacility['ConferenceLocation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Room'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['room']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accomodations'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['accomodations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capacity'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['capacity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($lodgingFacility['LodgingFacility']['comments']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lodging Facility'), array('action' => 'edit', $lodgingFacility['LodgingFacility']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lodging Facility'), array('action' => 'delete', $lodgingFacility['LodgingFacility']['id']), null, __('Are you sure you want to delete # %s?', $lodgingFacility['LodgingFacility']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodging Facilities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging Facility'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
	</ul>
</div>
