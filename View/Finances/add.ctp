<div class="content">
    <style>
        table {
            margin-bottom: 0px;
	}
        table tr td {
            border-bottom:0px;
        }
        table tr:nth-child(even) {
            background: #ffffff;
        }
    </style>
<?php echo $this->Form->create('Finance'); ?>
	<fieldset>
		<legend><?php echo __('Add Finance'); ?></legend>
	<table>
                <tr>
			<td width=100></td>
			<td><?php echo $this->Form->input('conference_id',array('empty' => true,'default' => null));?></td>
			<td><?php echo $this->Form->input('locality_id',array('empty' => true,'default' => null));?></td>
		</tr>
		<tr>
			<td width=100></td>
			<td><?php echo $this->Form->input('receive_date',array('label' => 'Date','empty' => true,'default' => null));?></td>
			<td><?php echo $this->Form->input('finance_type_id',array('label' => 'Description','empty' => true,'default' => null));?></td>
		</tr>
		<tr>
			<td width=100></td>
			<td><?php echo $this->Form->input('count');?></td>
			<td><?php echo $this->Form->input('rate');?></td>
		</tr>
		<tr>
			<td width=100></td>
                        <td><?php echo $this->Form->input('charge',array('label' => 'Charge (leave blank unless directed to fill in)'));?></td>
			<td>
                            <?php echo $this->Form->input('payment');
                            echo $this->Form->input('balance',array('hidden' => true,'label' => false));?>
                        </td>
		</tr>
                <tr>
			<td width=100></td>
			<td colspan="3"><?php echo $this->Form->input('comment');?></td>
		</tr>
            </table>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Finances'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
*/?>