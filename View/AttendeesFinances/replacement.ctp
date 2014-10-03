<div class="content">
<?php echo $this->Form->create('AttendeesFinance'); ?>
	<fieldset>
		<legend><?php echo __('Add Replacement'); ?></legend>
	<?php
		echo $this->Form->input('add_attendee_id',array('empty' => true,'default' => null));
		echo $this->Form->input('cancel_attendee_id',array('empty' => true,'default' => null));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>