<div class="conferenceDeadlineExceptions view">
<h2><?php  echo __('Conference Deadline Exception'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadlineException['ConferenceDeadlineException']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference'); ?></dt>
		<dd>
			<?php echo $this->Html->link($conferenceDeadlineException['Conference']['id'], array('controller' => 'conferences', 'action' => 'view', $conferenceDeadlineException['Conference']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conference Deadline'); ?></dt>
		<dd>
			<?php echo $this->Html->link($conferenceDeadlineException['ConferenceDeadline']['name'], array('controller' => 'conference_deadlines', 'action' => 'view', $conferenceDeadlineException['ConferenceDeadline']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadlineException['ConferenceDeadlineException']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($conferenceDeadlineException['ConferenceDeadlineException']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Conference Deadline Exception'), array('action' => 'edit', $conferenceDeadlineException['ConferenceDeadlineException']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Conference Deadline Exception'), array('action' => 'delete', $conferenceDeadlineException['ConferenceDeadlineException']['id']), null, __('Are you sure you want to delete # %s?', $conferenceDeadlineException['ConferenceDeadlineException']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadline Exceptions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline Exception'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conferences'), array('controller' => 'conferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference'), array('controller' => 'conferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Conference Deadlines'), array('controller' => 'conference_deadlines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Conference Deadline'), array('controller' => 'conference_deadlines', 'action' => 'add')); ?> </li>
	</ul>
</div>
