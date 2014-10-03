<div class="financeTypes view">
<h2><?php  echo __('Finance Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($financeType['FinanceType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($financeType['FinanceType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($financeType['FinanceType']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Finance Type'), array('action' => 'edit', $financeType['FinanceType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Finance Type'), array('action' => 'delete', $financeType['FinanceType']['id']), null, __('Are you sure you want to delete # %s?', $financeType['FinanceType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Finance Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Finances'); ?></h3>
	<?php if (!empty($financeType['Finance'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Conference Id'); ?></th>
		<th><?php echo __('Receive Date'); ?></th>
		<th><?php echo __('Locality Id'); ?></th>
		<th><?php echo __('Finance Type Id'); ?></th>
		<th><?php echo __('Count'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Charge'); ?></th>
		<th><?php echo __('Payment'); ?></th>
		<th><?php echo __('Balance'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($financeType['Finance'] as $finance): ?>
		<tr>
			<td><?php echo $finance['id']; ?></td>
			<td><?php echo $finance['conference_id']; ?></td>
			<td><?php echo $finance['receive_date']; ?></td>
			<td><?php echo $finance['locality_id']; ?></td>
			<td><?php echo $finance['finance_type_id']; ?></td>
			<td><?php echo $finance['count']; ?></td>
			<td><?php echo $finance['rate']; ?></td>
			<td><?php echo $finance['charge']; ?></td>
			<td><?php echo $finance['payment']; ?></td>
			<td><?php echo $finance['balance']; ?></td>
			<td><?php echo $finance['comment']; ?></td>
			<td><?php echo $finance['creator_id']; ?></td>
			<td><?php echo $finance['created']; ?></td>
			<td><?php echo $finance['modifier_id']; ?></td>
			<td><?php echo $finance['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'finances', 'action' => 'view', $finance['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'finances', 'action' => 'edit', $finance['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'finances', 'action' => 'delete', $finance['id']), null, __('Are you sure you want to delete # %s?', $finance['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
