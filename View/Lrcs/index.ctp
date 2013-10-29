<div class="lrcs index">
	<h2><?php echo __('Lrcs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lrcs as $lrc): ?>
	<tr>
		<td><?php echo h($lrc['Lrc']['id']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['first_name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lrc['Locality']['name'], array('controller' => 'localities', 'action' => 'view', $lrc['Locality']['id'])); ?>
		</td>
		<td><?php echo h($lrc['Lrc']['gender']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['email']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['comment']); ?>&nbsp;</td>
		<td><?php echo h($lrc['Lrc']['active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lrc['Lrc']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lrc['Lrc']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lrc['Lrc']['id']), null, __('Are you sure you want to delete # %s?', $lrc['Lrc']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lrc'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Localities'), array('controller' => 'localities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Locality'), array('controller' => 'localities', 'action' => 'add')); ?> </li>
	</ul>
</div>
