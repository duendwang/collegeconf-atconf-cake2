<div class="rateTypes form">
<?php echo $this->Form->create('RateType'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Rate Type'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RateType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RateType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rate Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rates'), array('controller' => 'rates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate'), array('controller' => 'rates', 'action' => 'add')); ?> </li>
	</ul>
</div>
