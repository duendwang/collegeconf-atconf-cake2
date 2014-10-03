<div class="rateTypes view">
<h2><?php  echo __('Rate Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rateType['RateType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($rateType['RateType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($rateType['RateType']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rate Type'), array('action' => 'edit', $rateType['RateType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rate Type'), array('action' => 'delete', $rateType['RateType']['id']), null, __('Are you sure you want to delete # %s?', $rateType['RateType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rates'), array('controller' => 'rates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate'), array('controller' => 'rates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rates'); ?></h3>
	<?php if (!empty($rateType['Rate'])): ?>
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
		foreach ($rateType['Rate'] as $rate): ?>
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
