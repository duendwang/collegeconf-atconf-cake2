<div class="finances index">
	<h2><?php echo __('Finances'); ?></h2>
	<div class="filter">
            <?php    
            echo $this->Form->create('Finance', array(
                'url' => array_merge(array('action' => 'index'), $this->params['pass'])
                ));
            echo $this->Form->input('locality', array('div' => false, 'empty' => true));
            echo $this->Form->submit(__('Search', true), array('div' => false));
            echo $this->Form->end();
            //echo '<br><br>'.$this->Form->button('Add New Attendee',array('type' => 'button','onclick' => "location.href='".$this->Html->url(array('action' => 'add'))."'"));?>
        </div>
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('receive_date'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('finance_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('count'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('charge'); ?></th>
			<th><?php echo $this->Paginator->sort('payment'); ?></th>
			<th><?php echo $this->Paginator->sort('balance'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('creator_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modifier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($finances as $finance): ?>
	<tr>
		<td><?php echo h($finance['Finance']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($finance['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $finance['Conference']['id'])); ?>
		</td>
		<td><?php echo h($finance['Finance']['receive_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($finance['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $finance['Locality']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($finance['FinanceType']['name'], array('controller' => 'finance_types', 'action' => 'view', $finance['FinanceType']['id'])); ?>
		</td>
		<td><?php echo h($finance['Finance']['count']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['rate']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['charge']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['payment']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['balance']); ?>&nbsp;</td>
		<td><?php echo h($finance['Finance']['comment']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($finance['Creator']['id'], array('controller' => 'users', 'action' => 'view', $finance['Creator']['id'])); ?>
		</td>
		<td><?php echo h($finance['Finance']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($finance['Modifier']['id'], array('controller' => 'users', 'action' => 'view', $finance['Modifier']['id'])); ?>
		</td>
		<td><?php echo h($finance['Finance']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $finance['Finance']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $finance['Finance']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $finance['Finance']['id']), null, __('Are you sure you want to delete # %s?', $finance['Finance']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Finance'), array('action' => 'add')); ?></li>
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
