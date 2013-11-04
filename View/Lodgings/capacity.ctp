<div class="content">
	<h2><?php echo __('Available Capacity Report');?></h2>
	<table cellpadding="0" cellspacing="0" class="sortable">
			<th>Housing</th>
                        <th>Room</th>
			<?php /**<th>Host Locality</th>**/?>
			<th>Available Capacity</th>
                        <?php /**<th>Capacity Occupied</th>**/?>
                        <th>Locality Assigned</th>
                        <th>Gender Assigned</th>                        
	<?php foreach ($capacities as $capacity): ?>
	<tr>
            <td>
                <?php echo h($capacity['house']);
                //echo $this->Html->link($capacity['housing'], array('controller' => 'lodgings', 'action' => 'edit', $capacity['lodgings1']['id'])); ?>
            </td>
            <td><?php echo h($capacity['room']); ?>&nbsp;</td>
            <td><?php echo h($capacity['openings']); ?>&nbsp;</td>
            <td><?php echo h($capacity['assigned_locality']); ?>&nbsp;</td>
            <td><?php echo h($capacity['assigned_gender']); ?>&nbsp;</td>
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