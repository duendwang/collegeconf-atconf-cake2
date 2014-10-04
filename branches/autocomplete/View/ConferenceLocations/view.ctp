<div class="conferenceLocations view">
<h2><?php  echo __('Conference Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($conferenceLocation['ConferenceLocation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($conferenceLocation['ConferenceLocation']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Conference Location'), array('action' => 'edit', $conferenceLocation['ConferenceLocation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Conference Location'), array('action' => 'delete', $conferenceLocation['ConferenceLocation']['id']), null, __('Are you sure you want to delete # %s?', $conferenceLocation['ConferenceLocation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodging Facilities'), array('controller' => 'lodging_facilities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging Facility'), array('controller' => 'lodging_facilities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rates'), array('controller' => 'rates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate'), array('controller' => 'rates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Conferences'); ?></h3>
	<?php if (!empty($conferenceLocation['Conference'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Term'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Part'); ?></th>
		<th><?php echo __('Conference Location Id'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conferenceLocation['Conference'] as $conference): ?>
		<tr>
			<td><?php echo $conference['id']; ?></td>
			<td><?php echo $conference['term']; ?></td>
			<td><?php echo $conference['year']; ?></td>
			<td><?php echo $conference['part']; ?></td>
			<td><?php echo $conference['conference_location_id']; ?></td>
			<td><?php echo $conference['start_date']; ?></td>
			<td><?php echo $conference['code']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'conferences', 'action' => 'view', $conference['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'conferences', 'action' => 'edit', $conference['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'conferences', 'action' => 'delete', $conference['id']), null, __('Are you sure you want to delete # %s?', $conference['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Lodging Facilities'); ?></h3>
	<?php if (!empty($conferenceLocation['LodgingFacility'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Location Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Room'); ?></th>
		<th><?php echo __('Accomodations'); ?></th>
		<th><?php echo __('Capacity'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Comments'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conferenceLocation['LodgingFacility'] as $lodgingFacility): ?>
		<tr>
			<td><?php echo $lodgingFacility['id']; ?></td>
			<td><?php echo $lodgingFacility['conference_location_id']; ?></td>
			<td><?php echo $lodgingFacility['code']; ?></td>
			<td><?php echo $lodgingFacility['location']; ?></td>
			<td><?php echo $lodgingFacility['room']; ?></td>
			<td><?php echo $lodgingFacility['accomodations']; ?></td>
			<td><?php echo $lodgingFacility['capacity']; ?></td>
			<td><?php echo $lodgingFacility['address']; ?></td>
			<td><?php echo $lodgingFacility['city']; ?></td>
			<td><?php echo $lodgingFacility['zip']; ?></td>
			<td><?php echo $lodgingFacility['phone']; ?></td>
			<td><?php echo $lodgingFacility['comments']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'lodging_facilities', 'action' => 'view', $lodgingFacility['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lodging_facilities', 'action' => 'edit', $lodgingFacility['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lodging_facilities', 'action' => 'delete', $lodgingFacility['id']), null, __('Are you sure you want to delete # %s?', $lodgingFacility['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lodging Facility'), array('controller' => 'lodging_facilities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Rates'); ?></h3>
	<?php if (!empty($conferenceLocation['Rate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Location Id'); ?></th>
		<th><?php echo __('Rate Type Id'); ?></th>
		<th><?php echo __('Cost'); ?></th>
		<th><?php echo __('Latefee Applies'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($conferenceLocation['Rate'] as $rate): ?>
		<tr>
			<td><?php echo $rate['id']; ?></td>
			<td><?php echo $rate['conference_location_id']; ?></td>
			<td><?php echo $rate['rate_type_id']; ?></td>
			<td><?php echo $rate['cost']; ?></td>
			<td><?php echo $rate['latefee_applies']; ?></td>
			<td><?php echo $rate['active']; ?></td>
			<td><?php echo $rate['comment']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rates', 'action' => 'view', $rate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rates', 'action' => 'edit', $rate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rates', 'action' => 'delete', $rate['id']), null, __('Are you sure you want to delete # %s?', $rate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rate'), array('controller' => 'rates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
