<div class="accountTypes view">
<h2><?php  echo __('Account Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($accountType['AccountType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($accountType['AccountType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($accountType['AccountType']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account Type'), array('action' => 'edit', $accountType['AccountType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account Type'), array('action' => 'delete', $accountType['AccountType']['id']), null, __('Are you sure you want to delete # %s?', $accountType['AccountType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related User Types'); ?></h3>
	<?php if (!empty($accountType['UserType'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Account Type Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($accountType['UserType'] as $userType): ?>
		<tr>
			<td><?php echo $userType['id']; ?></td>
			<td><?php echo $userType['user_id']; ?></td>
			<td><?php echo $userType['account_type_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_types', 'action' => 'view', $userType['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_types', 'action' => 'edit', $userType['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_types', 'action' => 'delete', $userType['id']), null, __('Are you sure you want to delete # %s?', $userType['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Type'), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
