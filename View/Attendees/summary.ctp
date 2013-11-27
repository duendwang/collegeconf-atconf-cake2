<div class="content">
	<h2><?php echo __('Attendee Summary by Locality'); ?></h2>
        <table cellpadding="0" cellspacing="0" class="sortable">
	<tr>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('total'); ?></th>
                        <th><?php echo $this->Paginator->sort('checked_in'); ?></th>
                        <th><?php echo $this->Paginator->sort('canceled'); ?></th>
                        <th><?php echo $this->Paginator->sort('excused/Replaced'); ?></th>
                        <th><?php echo $this->Paginator->sort('final_count'); ?></th>
                        <th><?php echo $this->Paginator->sort('total_charge'); ?></th>
	</tr>
	<?php
	foreach ($summaries as $summary): ?>
	<tr>
            <td><?php echo $this->Html->link($summary['Locality']['name'],array('action' => 'report',$summary['Locality']['id'])); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['total']); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['checked_in']); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['canceled']); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['excused']); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['remaining_registered']); ?>&nbsp;</td>
            <td><?php echo h($summary[0]['total_charge']); ?>&nbsp;</td>
        </tr>
        <?php endforeach;?>
        </table>
</div>
                
                <?php /**<td><?php echo h($attendee['Attendee']['id']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['barcode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $attendee['Conference']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->link($attendee['Attendee']['first_name'], array('action' => 'edit', $attendee['Attendee']['id']));?>

                </td>
                <td>
                    <?php echo $this->Html->link($attendee['Attendee']['last_name'], array('action' => 'edit', $attendee['Attendee']['id']));?></td>
		<td><?php echo h($attendee['Attendee']['gender']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Locality']['id'], array('controller' => 'localities', 'action' => 'view', $attendee['Locality']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attendee['Campus']['name'], array('controller' => 'campuses', 'action' => 'view', $attendee['Campus']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['lrc']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['conf_contact']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['new_one']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['group']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['allergies']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $attendee['Status']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['email']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['city_state']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_name']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_address']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['host_phone']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Lodging']['name'], array('controller' => 'lodgings', 'action' => 'view', $attendee['Lodging']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['add']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['submitter']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['PT']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['rate']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_at_conf']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['cancel']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['cancel_reason']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['comment']); ?>&nbsp;</td>
		<?php /**<td><?php echo h($attendee['Attendee']['amt_paid']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['check_num']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attendee['Attendee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attendee['Attendee']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attendee['Attendee']['id']), null, __('Are you sure you want to delete # %s?', $attendee['Attendee']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
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
	</div>
</div>
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Attendee'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campuses'), array('controller' => 'campuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campus'), array('controller' => 'campuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('controller' => 'lodgings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lodging'), array('controller' => 'lodgings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
	</ul>
</div>
**/?>