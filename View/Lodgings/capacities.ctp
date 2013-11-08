<div class="content">
	<h2><?php echo __('Available Capacity Report');?></h2>
	<table cellpadding="0" cellspacing="0" class="sortable">
			<th><?php echo $this->Paginator->sort('code'); ?></th>
                        <th><?php echo $this->Paginator->sort('location'); ?></th>
                        <th><?php echo $this->Paginator->sort('room'); ?></th>
			<th>Available Capacity</th>
                        <th>Localities Assigned</th>
                        <th>Gender Assigned</th>                        
	<?php foreach ($lodgings as $lodging): ?>
	<tr>
            <td><?php echo h($lodging['Lodging']['code']); ?>&nbsp;</td>
            <td><?php echo h($lodging['Lodging']['name']); ?>&nbsp;</td>
            <td><?php echo h($lodging['Lodging']['room']); ?>&nbsp;</td>
            <td><?php echo $lodging['Lodging']['capacity'] - $lodging['Lodging']['attendee_count']; ?>&nbsp;</td>
            <td><?php echo h($lodging['Lodging']['localities']); ?>&nbsp;</td>
            <td><?php echo h($lodging['Attendee'][0]['gender']); ?>&nbsp;</td>
	</tr>
        <?php endforeach; ?>
	</table>
</div>
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Lodgings'), array('action' => 'index')); ?> </li>
	</ul>
</div>
**/?>