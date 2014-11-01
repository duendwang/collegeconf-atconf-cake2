<div class="content">
    <h2><?php echo __('Check-in Report');?></h2>
    <br>
    <h4>General</h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td width="400"><?php echo h('Total checked in'); ?>&nbsp;</td>
            <td><?php echo h($checked_in_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Canceled'; ?>&nbsp;</td>
            <td><?php echo h($canceled_count); ?>&nbsp;</td>
	</tr>
	<tr>
            <td><?php echo 'Not checked in'; ?>&nbsp;</td>
            <td><?php echo h($not_checked_in_count); ?>&nbsp;</td>
	</tr>
    </table>
    <br>
    <h4>Students</h4>
    <table cellpadding="0" cellspacing="0">
        <?php /**<tr>
            <td><?php echo 'High School'; ?>&nbsp;</td>
            <td><?php echo h($high_school_count); ?>&nbsp;</td>
	</tr>**/?>
	<tr>
            <td width="400"><?php echo 'College Students (w/o graduate students)'; ?>&nbsp;</td>
            <td><?php echo h($college_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Freshmen'; ?>&nbsp;</td>
            <td><?php echo h($freshmen_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Sophomores'; ?>&nbsp;</td>
            <td><?php echo h($soph_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Juniors'; ?>&nbsp;</td>
            <td><?php echo h($jr_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Seniors'; ?>&nbsp;</td>
            <td><?php echo h($senior_count); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Graduate Students'; ?>&nbsp;</td>
            <td><?php echo h($grad_count); ?>&nbsp;</td>
	</tr>
    </table>
    <br>
    <h4>Engedi</h4>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td width="400"><?php echo 'Engedi Friday Night'; ?>&nbsp;</td>
            <td><?php echo h($fri_engedi); ?>&nbsp;</td>
	</tr>
        <tr>
            <td><?php echo 'Engedi Saturday Night'; ?>&nbsp;</td>
            <td><?php echo h($sat_engedi); ?>&nbsp;</td>
	</tr>
    </table>
    <br>
    <h4>Time Slots</h4>
    <table cellpadding="0" cellspacing="0">
    <?php foreach($time_slots as $time_slot): ?>
        <tr>
            <td width="400"><?php echo h($time_slot['name']); ?>&nbsp;</td>
            <td><?php echo h($time_slot['count']); ?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>