<div class="finances form">
<?php echo $this->Form->create('Finance'); ?>
	<fieldset>
		<legend><?php echo __('Edit Finance'); ?></legend>
	<?php
		echo $this->Form->hidden('referer',array('default' => $referer));
                echo $this->Form->input('id');
		echo $this->Form->input('conference_id');
		echo $this->Form->input('receive_date');
		echo $this->Form->input('locality_id');
		echo $this->Form->input('finance_type_id');
		echo $this->Form->input('count');
		echo $this->Form->input('rate');
		echo $this->Form->input('charge');
		echo $this->Form->input('payment');
		echo $this->Form->input('balance');
		echo $this->Form->input('comment');
		echo $this->Form->input('creator_id');
		echo $this->Form->input('modifier_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Finance.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Finance.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Finances'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Finance Types'), array('controller' => 'finance_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Type'), array('controller' => 'finance_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('controller' => 'attendees_finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Finance Attendee'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php /**  
        echo $this->Html->scriptBlock('
                function displayBalance() {
                    var count = $("#FinanceCount").val();
                    var rate = $("#FinanceRate").val();                
                    var charge = -count*rate;
                    var payment = $("#FinancePayment").val()
                    var balance = Number(charge) + Number(payment);   
                    $("#FinanceCharge").val(charge);
                    $("#FinanceBalance").val(balance);                    
                }

                $("#FinanceCount").change(displayBalance);
                $("#FinanceRate").change(displayBalance);
                $("#FinanceCharge").change(displayBalance);
                $("#FinancePayment").change(displayBalance);
                
                displayBalance();');
        
        //$this->Js->event('keypress', '$(\'input[name="data[Attendee][id]"]\').val(\'\');')
        echo $this->Js->writeBuffer();
**/ ?>