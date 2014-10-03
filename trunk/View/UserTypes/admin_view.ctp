<div class="userTypes view">
<h2><?php  echo __('User Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userType['UserType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userType['User']['id'], array('controller' => 'users', 'action' => 'view', $userType['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userType['AccountType']['name'], array('controller' => 'account_types', 'action' => 'view', $userType['AccountType']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Type'), array('action' => 'edit', $userType['UserType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Type'), array('action' => 'delete', $userType['UserType']['id']), null, __('Are you sure you want to delete # %s?', $userType['UserType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Types'), array('controller' => 'account_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Type'), array('controller' => 'account_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
