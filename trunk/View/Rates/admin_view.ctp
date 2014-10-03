<div class="rates view">
<h2><?php  echo __('Rate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rate['Rate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rate['ConferenceLocation']['name'], array('controller' => 'conference_locations', 'action' => 'view', $rate['ConferenceLocation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rate['RateType']['name'], array('controller' => 'rate_types', 'action' => 'view', $rate['RateType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cost'); ?></dt>
		<dd>
			<?php echo h($rate['Rate']['cost']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latefee Applies'); ?></dt>
		<dd>
			<?php echo h($rate['Rate']['latefee_applies']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($rate['Rate']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($rate['Rate']['comment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rate'), array('action' => 'edit', $rate['Rate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rate'), array('action' => 'delete', $rate['Rate']['id']), null, __('Are you sure you want to delete # %s?', $rate['Rate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Locations'), array('controller' => 'conference_locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Location'), array('controller' => 'conference_locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Types'), array('controller' => 'rate_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Type'), array('controller' => 'rate_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
