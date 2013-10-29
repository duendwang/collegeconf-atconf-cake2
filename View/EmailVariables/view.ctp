<div class="emailVariables view">
<h2><?php  echo __('Email Variable'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($emailVariable['EmailVariable']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($emailVariable['EmailVariable']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($emailVariable['EmailVariable']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($emailVariable['EmailVariable']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Email Variable'), array('action' => 'edit', $emailVariable['EmailVariable']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Email Variable'), array('action' => 'delete', $emailVariable['EmailVariable']['id']), null, __('Are you sure you want to delete # %s?', $emailVariable['EmailVariable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Variables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Variable'), array('action' => 'add')); ?> </li>
	</ul>
</div>
