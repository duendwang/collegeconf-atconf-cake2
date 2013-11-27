<div class="content">
	<h2><?php echo __($locality['Locality']['name'].' Finances'); ?></h2>
        <br><?php echo $this->Html->link('View '.$locality['Locality']['name'].' Attendees',array('controller' => 'attendees','action' => 'report',$locality['Locality']['id']));?><br><br>
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('receive_date'); ?></th>
			<th><?php echo $this->Paginator->sort('Locality.name'); ?></th>
			<th><?php echo $this->Paginator->sort('FinanceType.name'); ?></th>
			<th><?php echo $this->Paginator->sort('count'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('charge'); ?></th>
			<th><?php echo $this->Paginator->sort('payment'); ?></th>
			<th><?php echo $this->Paginator->sort('balance'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
	</tr>
	<?php
        if (isset($finances)) {
	foreach ($finances as $finance): ?>
	<tr>
		<td><?php echo $this->Html->link(__($finance['Finance']['receive_date']),array('action' => 'edit',$finance['Finance']['id'])); ?></td>
		<td>
			<?php echo h($finance['Locality']['name']); ?>
		</td>
		<td><?php echo h($finance['FinanceType']['name']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['count']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['rate']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['charge']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['payment']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['balance']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['comment']); ?>&nbsp;</td>
		<?php /**<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $finance['Finance']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $finance['Finance']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $finance['Finance']['id']), null, __('Are you sure you want to delete # %s?', $finance['Finance']['id'])); ?>
		</td>**/?>
	</tr>
<?php endforeach; 
if (isset($totals)) { ?>
	<tr></tr>
        <tr>
            <td colspan="3" style="background-color:white">
                <h3><br><?php echo __('Totals');?></h3>
            </td>
        </tr>
<?php foreach ($totals as $total): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($total['Conference']['code'], array('controller' => 'conferences', 'action' => 'view', $total['Conference']['id'])); ?>
            </td>
            <td><?php if (isset($total['Locality'])) echo h($total['Locality']['name']);?></td>
            <td></td>
            <td><?php echo h($total[0]['total_count']);?>&nbsp;</td>
            <td></td>
            <td><?php echo h($total[0]['total_charge']);?>&nbsp;</td>
            <td><?php echo h($total[0]['total_payment']);?>&nbsp;</td>
            <td><?php echo h($total[0]['total_balance']);?>&nbsp;</td>
            <td>
                <?php if($total[0]['total_balance'] < 0) echo __('Balance due');
                else echo __('Credit: do not pay');?>
            </td>
        </tr>
<?php endforeach;
        }
        }?>
        </table>
	<?php /**<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>*/?>
</div>
<!--<div class="actions">
	<h3><?php /**echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Finance'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); **/?> </li>
	</ul>
</div>-->
