<div class="attendees index">
    <h2><?php echo __('Check-in Report');?></h2>
    <table cellpadding="0" cellspacing="0" class="sortable">
        <tr>
            <th>Type</th>
            <th>Count</th>
        </tr>
        <tr>
            <td><?php echo h('Total checked in'); ?>&nbsp;</td>
            <td><?php echo h($checked_in_count); ?>&nbsp;</td>
	</tr>
        <?php /**<tr>
            <td><?php echo 'High School'; ?>&nbsp;</td>
            <td><?php echo h($high_school_count); ?>&nbsp;</td>
	</tr>**/?>
	<tr>
            <td><?php echo 'College Students'; ?>&nbsp;</td>
            <td><?php echo h($college_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Canceled'; ?>&nbsp;</td>
            <td><?php echo h($canceled_count); ?>&nbsp;</td>
	</tr>
	<tr>
            <td><?php echo 'Not checked in'; ?>&nbsp;</td>
            <td><?php echo h($not_checked_in_count); ?>&nbsp;</td>
	</tr>
    <?php foreach($time_slots as $time_slot): ?>
        <tr>
            <td><?php echo h($time_slot['name']); ?>&nbsp;</td>
            <td><?php echo h($time_slot['count']); ?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Attendees'), array('action' => 'index')); ?> </li>
	</ul>
</div>