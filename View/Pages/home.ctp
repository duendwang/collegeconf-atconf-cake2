<div id="content">
	<h2>Welcome!</h2><h2>What would you like to do?</h2><br>
	<table>
		<tr>
			<td width=50></td>
                        <td>
				<p><?php echo $this->Html->link(__('Check in attendee'), array('controller' => 'checkIns', 'action' => 'checkIn')); ?></p>
                                <p><?php echo $this->Html->link(__('Cashier'), array('controller' => 'onsiteRegistrations', 'action' => 'cashier')); ?></p>
                                <p><?php echo $this->Html->link(__('Badges'), array('controller' => 'onsiteRegistrations', 'action' => 'badges')); ?></p>
                                <p><?php echo $this->Html->link(__('CC Desk'), array('controller' => 'attendees', 'action' => 'cc_desk')); ?></p>
				<p><?php echo $this->Html->link(__('Cancel attendee'), array('controller' => 'attendees', 'action' => 'cancel')); ?></p>
				<p><?php echo $this->Html->link(__('Add new attendee'), array('controller' => 'attendees', 'action' => 'add')); ?></p>
				<p><?php echo $this->Html->link(__('Find open hospitality'), array('controller' => 'lodgings', 'action' => 'capacity')); ?></p>
				<p><?php echo $this->Html->link(__('Attendee self registration'), array('action' => 'display','registration')); ?></p>
                                <p><?php echo $this->Html->link(__('Enter finances'), array('controller' => 'finances', 'action' => 'add')); ?></p>
			</td>
			<td>
				<p><?php echo $this->Html->link(__('View conference contacts'), array('controller' => 'attendees', 'action' => 'cc_report')); ?></p>
				<p><?php echo $this->Html->link(__('View check-in statistics'), array('controller' => 'checkIns', 'action' => 'report')); ?></p>
                                <p><?php echo $this->Html->link(__('View checked-in attendees'), array('controller' => 'checkIns', 'action' => 'index')); ?></p>
                                <p><?php echo $this->Html->link(__('View canceled attendees (instructions only)'), array('controller' => 'attendees', 'action' => 'cancel_report')); ?></p>
                                <p><?php echo $this->Html->link(__('View attendees not yet checked in'), array('controller' => 'attendees', 'action' => 'noshow_report')); ?></p>
                                <p><?php echo $this->Html->link(__('View attendee summary by locality'), array('controller' => 'attendees', 'action' => 'summary')); ?></p>
				<p><?php echo $this->Html->link(__('View finance summary by locality'), array('controller' => 'finances', 'action' => 'report')); ?></p>
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
                    <p><?php echo $this->Html->link(__('partTimeRegistrations'), array('controller' => 'partTimeRegistrations')); ?></p>
                    <p><?php echo $this->Html->link(__('Payments'), array('controller' => 'payments')); ?></p>
                    <p><?php echo $this->Html->link(__('Rates'), array('controller' => 'rates')); ?></p>
                    <p><?php echo $this->Html->link(__('Statuses'), array('controller' => 'statuses')); ?></p>
                    <p><?php echo $this->Html->link(__('TimeCodes'), array('controller' => 'timeCodes')); ?></p>
                    <p><?php echo $this->Html->link(__('Users'), array('controller' => 'users')); ?></p>
		</td>
</div>