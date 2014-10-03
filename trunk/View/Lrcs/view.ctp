<div class="lrcs view">
<h2><?php  echo __('Lrc'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locality'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lrc['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $lrc['Locality']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($lrc['Lrc']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lrc'), array('action' => 'edit', $lrc['Lrc']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lrc'), array('action' => 'delete', $lrc['Lrc']['id']), null, __('Are you sure you want to delete # %s?', $lrc['Lrc']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lrcs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lrc'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
