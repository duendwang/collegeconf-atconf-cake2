<div class="lodgings index">
	<h2><?php echo __('Lodgings'); ?></h2>
	<div class="filter">
            <?php    
            echo $this->Form->create('Lodging', array(
                'url' => array_merge(array('action' => 'index'), $this->params['pass'])
                ));
            echo $this->Form->input('name', array('div' => false, 'empty' => true));
            echo $this->Form->input('locality', array('div' => false, 'empty' => true));
            echo $this->Form->input('city', array('div' => false, 'empty' => true));
            echo $this->Form->submit(__('Search', true), array('div' => false));
            echo $this->Form->end();
            ?>
        </div>
        <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('conference_id'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('home_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('pet'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('capacity'); ?></th>
			<th><?php echo $this->Paginator->sort('room'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lodgings as $lodging): ?>
	<tr>
		<td><?php echo h($lodging['Lodging']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lodging['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $lodging['Conference']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lodging['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $lodging['Locality']['id'])); ?>
		</td>
		<td><?php echo h($lodging['Lodging']['code']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['name']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['address']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['city']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['zip']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['home_phone']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['pet']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['gender']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['capacity']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['room']); ?>&nbsp;</td>
		<td><?php echo h($lodging['Lodging']['comment']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lodging['Lodging']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lodging['Lodging']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lodging['Lodging']['id']), null, __('Are you sure you want to delete # %s?', $lodging['Lodging']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lodging'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attendees'), array('controller' => 'attendees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attendee'), array('controller' => 'attendees', 'action' => 'add')); ?> </li>
	</ul>
</div>
