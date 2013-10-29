<div class="attendees index">
	<h2><?php echo __('Attendees'); ?></h2>
	<div class="filter">
            <?php    
            echo $this->Form->create('Attendee', array(
                'url' => array_merge(array('action' => 'index'), $this->params['pass'])
                ));
            echo $this->Form->input('name', array('div' => false, 'empty' => true));
            echo $this->Form->input('locality', array('div' => false, 'empty' => true));
            echo $this->Form->submit(__('Search', true), array('div' => false));
            echo $this->Form->end();
            //echo '<br><br>'.$this->Form->button('Add New Attendee',array('type' => 'button','onclick' => "location.href='".$this->Html->url(array('action' => 'add'))."'"));?>
        </div>
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('campus_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lrc'); ?></th>
			<th><?php echo $this->Paginator->sort('conf_contact'); ?></th>
			<th><?php echo $this->Paginator->sort('new_one'); ?></th>
			<th><?php echo $this->Paginator->sort('group'); ?></th>
			<th><?php echo $this->Paginator->sort('allergies'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('city_state'); ?></th>
			<th><?php echo $this->Paginator->sort('lodging_id'); ?></th>
			<th><?php echo $this->Paginator->sort('submitter'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_at_conf'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('amt_paid'); ?></th>
			<th><?php echo $this->Paginator->sort('check_num'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_date'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attendees as $attendee): ?>
	<tr>
		<td><?php echo h($attendee['Attendee']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $attendee['Conference']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['gender']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $attendee['Locality']['id'])); ?>
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
		<td>
			<?php echo $this->Html->link($attendee['Lodging']['name'], array('controller' => 'lodgings', 'action' => 'view', $attendee['Lodging']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['submitter']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['rate']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_at_conf']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['comment']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['amt_paid']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['check_num']); ?>&nbsp;</td>
		<td><?php echo h($attendee['Attendee']['paid_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Creator']['id'], array('controller' => 'users', 'action' => 'view', $attendee['Creator']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendee['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $attendee['Modifier']['id'])); ?>
		</td>
		<td><?php echo h($attendee['Attendee']['modified']); ?>&nbsp;</td>
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
<div class="actions">
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
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cancels'), array('controller' => 'cancels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cancel'), array('controller' => 'cancels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Check Ins'), array('controller' => 'check_ins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Check In'), array('controller' => 'check_ins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onsite Registrations'), array('controller' => 'onsite_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onsite Registration'), array('controller' => 'onsite_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Part Time Registrations'), array('controller' => 'part_time_registrations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Part Time Registration'), array('controller' => 'part_time_registrations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments'), array('controller' => 'payments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment'), array('controller' => 'payments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees Finances'), array('controller' => 'attendees_finances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee Finance Add'), array('controller' => 'attendees_finances', 'action' => 'add')); ?> </li>
	</ul>
</div>
