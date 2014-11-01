<div class="content">
    <h2><?php echo __('Canceled Attendees'); ?></h2><br>
        <?php /**<p>In <a href="http://registration.sccs.lan/phpmyadmin">phpmyadmin</a>, export the attendees, checkins, and localities tables as an Excel file.</p>
        <p>Open the exported file.</p>
        <p>Rename the attendees, checkins, and localities sheets to 'attendees', 'checkins', and 'localities' respectively.</p>
        <p>Create a new Locality column to the right of locality_id and perform a vlookup to display the locality name (=vlookup(xx,localities!A:B,2,false))</p>
        <p>Sort the checkin table by attendee_id in ascending order.</p>
        <p>Create a new Check In column to the right of all the data and perform a vlookup to display check-in information (=vlookup(xx.checkins!B:C,2,false))</p>
        <p>Filter out or delete all attendees that either have a null value in the 'cancel' column or have an entry in the Check In column.</p>
        <p>Further filter out or delete any attendees who were replaced by another as indicated in the comment column.</p>
        <p>Hide the necessary columns so that only the locality, first and last name, gender, rate, cancel, and cancel_reason fields are displayed.</p>
        <p>To the far right, add a Comments column. This is different from the original comment column that should be hidden.</p>
        <p>Add an appropriate page header and format the document so that it displays properly on one page. Print the document for the brothers.</p>
        **/?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('locality_id'); ?></th>
            <th><?php echo $this->Paginator->sort('first_name'); ?></th>
            <th><?php echo $this->Paginator->sort('last_name'); ?></th>
            <th><?php echo $this->Paginator->sort('gender'); ?></th>
            <th><?php echo $this->Paginator->sort('rate'); ?></th>
            <th><?php echo $this->Paginator->sort('Cancel.created','Cancelled'); ?></th>
            <th><?php echo $this->Paginator->sort('Cancel.reason','Reason'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
    <?php foreach ($cancellations as $cancellation): ?>
	<tr>
            <td><?php echo h($cancellation['Locality']['name']); ?>&nbsp;</td>
            <td><?php echo $this->Html->link($cancellation['Attendee']['first_name'],array('action' => 'view',$cancellation['Attendee']['id'])); ?>&nbsp;</td>
            <td><?php echo $this->Html->link($cancellation['Attendee']['last_name'],array('action' => 'view',$cancellation['Attendee']['id'])); ?>&nbsp;</td>
            <td><?php echo h($cancellation['Attendee']['gender']); ?>&nbsp;</td>
            <td><?php echo h($cancellation['Attendee']['rate']); ?>&nbsp;</td>
            <td><?php echo h($cancellation['Cancel']['created']); ?>&nbsp;</td>
            <td>
                <?php if ($cancellation['Attendee']['cancel_count'] == 1 && !empty($cancellation['AttendeeFinanceCancel'])) {
                    echo 'Excused: '.h($cancellation['Cancel']['reason']);
                } else {
                    echo h($cancellation['Cancel']['reason']);
                } ?> &nbsp;
            </td>
            <td class="actions">
                <?php if($cancellation['Attendee']['cancel_count'] == 1) {
                    if (!empty($cancellation['AttendeeFinanceCancel'])) {
                        echo $this->Form->postLink(__('UNexcuse Cancellation'), array('controller' => 'attendees', 'action' => 'unexcuse_cancellation', $cancellation['Attendee']['id']), null, __('Are you sure you want to UNexcuse %s\'s cancellation?', $cancellation['Attendee']['name']));
                    } else {
                        echo $this->Form->postLink(__('Excuse Cancellation'), array('controller' => 'attendees', 'action' => 'excuse_cancellation', $cancellation['Attendee']['id']), null, __('Are you sure you want to excuse %s\'s cancellation?', $cancellation['Attendee']['name']));
                    }
                } ?>
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