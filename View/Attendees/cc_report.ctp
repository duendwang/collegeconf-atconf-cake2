<div class="content">
        <h2><?php echo __('Conference Contacts');?></h2>
	<table cellpadding="0" cellspacing="0">
			<th><?php echo $this->Paginator->sort('locality_id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('Checked In?'); ?></th>
	<?php foreach ($confcontacts as $confcontact): ?>
	<tr>
      	<td><?php echo h($confcontact['Locality']['city']); ?>&nbsp;</td>
		<td><?php echo h($confcontact['Attendee']['first_name']); ?>&nbsp;</td>
        <td><?php echo h($confcontact['Attendee']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($confcontact['Attendee']['gender']); ?>&nbsp;</td>
        <td><?php echo h($confcontact['Attendee']['cell_phone']); ?>&nbsp;</td>
        <td><?php if(!isset($confcontact['CheckIn']['id'])) {
				echo 'No';
			} else {
				echo 'Yes';} ?>&nbsp;</td>
	</tr>
        <?php endforeach; ?>
	</table>
</div>
<?php /**<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?> </li>
	</ul>
</div>
**/ ?>