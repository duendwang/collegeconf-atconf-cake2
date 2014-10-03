<div class="financeTypes form">
<?php echo $this->Form->create('FinanceType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Finance Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FinanceType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FinanceType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Finance Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Finances'), array('controller' => 'finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance'), array('controller' => 'finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
