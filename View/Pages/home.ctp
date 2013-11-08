<div id="content">
    <style>
        table {
            margin-bottom: 0px;
	}
        table tr td {
            border-bottom:0px;
        }
        table tr:nth-child(even) {
            background: #ffffff;
        }
    </style>
    <h2>Welcome!</h2><h2>What would you like to do?</h2><br>
    <table>
        <tr>
            <td width=25></td>
            <td>
                <h3>Conference Stations:</h3>
            </td>
            <td>
                <h3>Reports:</h3>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-left:2em">
                <p><?php echo $this->Html->link(__('Check in attendee'), array('controller' => 'checkIns', 'action' => 'add')); ?></p>
		<p><?php echo $this->Html->link(__('Add new attendee'), array('controller' => 'attendees', 'action' => 'add')); ?></p>
		<p><?php echo $this->Html->link(__('Cancel attendee'), array('controller' => 'cancels', 'action' => 'add')); ?></p>
                <p><?php echo $this->Html->link(__('Enter finances'), array('controller' => 'finances', 'action' => 'add')); ?></p>
		<p><?php echo $this->Html->link(__('View lodgings'), array('controller' => 'lodgings', 'action' => 'capacities')); ?></p>
                <?php /**<p><?php echo $this->Html->link(__('Badges'), array('controller' => 'onsiteRegistrations', 'action' => 'badges')); ?></p>**/?>
                <p><?php echo $this->Html->link(__('Cashier'), array('controller' => 'onsiteRegistrations', 'action' => 'cashier')); ?></p>
                <?php /**<p><?php echo $this->Html->link(__('CC form processing'), array('controller' => 'attendees', 'action' => 'cc_desk')); ?></p>**/?>
		<?php /**<p><?php echo $this->Html->link(__('Attendee self registration'), array('action' => 'display','registration')); ?></p>**/?>
            </td>
            <td style="padding-left:2em">
                <p><?php echo $this->Html->link(__('Conference contacts'), array('controller' => 'attendees', 'action' => 'cc_report')); ?></p>
		<p><?php echo $this->Html->link(__('Check-in statistics'), array('controller' => 'attendees', 'action' => 'checkin_stats')); ?></p>
                <p><?php echo $this->Html->link(__('Checked-in attendees'), array('controller' => 'checkIns', 'action' => 'index')); ?></p>
                <p><?php echo $this->Html->link(__('Canceled attendees'), array('controller' => 'attendees', 'action' => 'cancel_report')); ?></p>
                <p><?php echo $this->Html->link(__('Canceled and No-show attendees'), array('controller' => 'attendees', 'action' => 'cancel_report',true)); ?></p>
                <?php /**<p><?php echo $this->Html->link(__('Attendees not yet checked in'), array('controller' => 'attendees', 'action' => 'noshow_report')); ?></p>**/?>
                <p><?php echo $this->Html->link(__('Attendee summary by locality'), array('controller' => 'attendees', 'action' => 'summary')); ?></p>
		<p><?php echo $this->Html->link(__('Finance summary by locality'), array('controller' => 'finances', 'action' => 'summary')); ?></p>
            </td>
        </tr>
    </table><br>
    <h2>Other tasks:</h2>
    <td class = "actions">
        <p><?php echo $this->Html->link(__('Attendees'), array('controller' => 'attendees')); ?></p>
        <p><?php echo $this->Html->link(__('Campuses'), array('controller' => 'campuses')); ?></p>
        <p><?php echo $this->Html->link(__('Conferences'), array('controller' => 'conferences')); ?></p>
        <p><?php echo $this->Html->link(__('Finances'), array('controller' => 'finances')); ?></p>
        <p><?php echo $this->Html->link(__('Localities'), array('controller' => 'localities')); ?></p>
        <p><?php echo $this->Html->link(__('LodgingFacilities'), array('controller' => 'lodgingFacilities')); ?></p>
        <p><?php echo $this->Html->link(__('Lodgings'), array('controller' => 'lodgings')); ?></p>
        <p><?php echo $this->Html->link(__('Lrcs'), array('controller' => 'lrcs')); ?></p>
        <p><?php echo $this->Html->link(__('OnsiteRegistrations'), array('controller' => 'onsiteRegistrations')); ?></p>
        <p><?php echo $this->Html->link(__('PartTimeRegistrations'), array('controller' => 'partTimeRegistrations')); ?></p>
        <p><?php echo $this->Html->link(__('Payments'), array('controller' => 'payments')); ?></p>
        <p><?php echo $this->Html->link(__('Rates'), array('controller' => 'rates')); ?></p>
        <p><?php echo $this->Html->link(__('Statuses'), array('controller' => 'statuses')); ?></p>
        <p><?php echo $this->Html->link(__('TimeCodes'), array('controller' => 'timeCodes')); ?></p>
        <p><?php echo $this->Html->link(__('Users'), array('controller' => 'users')); ?></p>
    </td>
</div>