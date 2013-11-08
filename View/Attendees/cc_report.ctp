<div class="content">
    <h2><?php echo __('Conference Contacts');?></h2>
    <table cellpadding="0" cellspacing="0">
        <th><?php echo $this->Paginator->sort('Locality.name'); ?></th>
	<th><?php echo $this->Paginator->sort('first_name'); ?></th>
	<th><?php echo $this->Paginator->sort('last_name'); ?></th>
	<th><?php echo $this->Paginator->sort('gender'); ?></th>
	<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
	<th><?php echo $this->Paginator->sort('check_in_count','Status'); ?></th>
    <?php foreach ($confcontacts as $confcontact): ?>
	<tr>
            <td><?php echo h($confcontact['Locality']['name']); ?>&nbsp;</td>
            <td><?php echo h($confcontact['Attendee']['first_name']); ?>&nbsp;</td>
            <td><?php echo h($confcontact['Attendee']['last_name']); ?>&nbsp;</td>
            <td><?php echo h($confcontact['Attendee']['gender']); ?>&nbsp;</td>
            <td><?php echo h($confcontact['Attendee']['cell_phone']); ?>&nbsp;</td>
            <td>
                <?php if ($confcontact['Attendee']['check_in_count'] == 1 && $confcontact['Attendee']['cancel_count'] == 1) {
                    echo '<font color="FF0000">Checked in and canceled';
                } elseif ($confcontact['Attendee']['check_in_count'] == 1) {
                    echo '<font color="00FF00">Checked in';
                } elseif ($confcontact['Attendee']['cancel_count'] == 1) {
                    echo '<font color="FF00FF">Canceled';
                } else {
                    echo h('Registered');
                } ?>&nbsp;
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>