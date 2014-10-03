<div class="lrcs form">
<?php echo $this->Form->create('Lrc'); ?>
	<fieldset>
		<legend><?php echo __('Add Lrc'); ?></legend>
	<?php
		echo $this->Form->input('last_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('gender');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('email');
		echo $this->Form->input('comment');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lrcs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
