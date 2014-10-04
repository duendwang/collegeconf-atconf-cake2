<div class="emailVariables form">
<?php echo $this->Form->create('EmailVariable'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Email Variable'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('value');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Email Variables'), array('action' => 'index')); ?></li>
	</ul>
</div>
