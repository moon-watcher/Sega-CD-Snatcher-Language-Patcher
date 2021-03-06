<div class="saves index">
	<h2>
		<?php echo __('Quicksaves List'); ?>
	</h2>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add Quicksave'), array('action' => 'add')); ?>
			</li>
		</ul>
	</div>
	<table>
		<tr>
			<th width="5%"><?php echo $this->Paginator->sort('act', __('Act')); ?>
			</th>
			<th width="5%"><?php echo $this->Paginator->sort('BinaryFile.filename', __('BinaryFile')); ?>
			</th>
			<th width="5%"><?php echo $this->Paginator->sort('slot', __('Slot')); ?>
			</th>
			<th width="10%"><?php echo $this->Paginator->sort('User.username', __('Username')); ?>
			</th>
			<th width="45%"><?php echo $this->Paginator->sort('description', __('Description')); ?>
			</th>
			<th width="15%"><?php echo $this->Paginator->sort('created', __('Created')); ?>
			</th>
			<th width="15%" class="actions"><?php echo __('Actions'); ?>
			</th>
		</tr>

		<tr class="search">
			<?php echo $this->Form->create('Quicksave', array('url' => array('action' => 'search')));?>

			<th><?php 
			echo $this->Form->input('Search.act', array(
				'required' => false,
				'label' => false,
				'type' => 'select',
				'empty' => '',
				'onchange' => 'this.form.submit();',
				'options' => array(1 => 1, 2 => 2, 3 => 3),
		));

		?>
			</th>
			<th><?php echo $this->Form->input(
					'Search.binary_file_id',
					array('label' => false,
						'required' => false,
						'empty' => '',
						'onchange' => 'this.form.submit();')
				);
			?>
			</th>

			<th><?php echo $this->Form->input(
					'Search.slot', 
					array(
					'label' => false,
					'required' => false,
					'type' => 'select',
					'empty' => '',
					'options' => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
					'onchange' => 'this.form.submit();')
			);
			?>
			</th>


			<th><?php echo $this->Form->input(
					'Search.user_id',
					array('label' => false,
									'empty' => '',
									'onchange' => 'this.form.submit();')
							);
			?>
			</th>

			<th><?php echo $this->Form->input(
					'Search.description',
					array('label' => false,
									'type' => 'text',
									'size' => 20,
									'maxlength' => 255));
			?></th>

			<th></th>

			<th class="search"><?php echo $this->Form->submit(__('Search'), array('div' => false)); ?>
			</th>
			<?php echo $this->Form->end();?>
		</tr>

		<?php
	foreach ($quicksaves as $quicksave): ?>
		<tr>
			<td><?php echo h($quicksave['Quicksave']['act']); ?>
			</td>
			<td><?php echo h($quicksave['BinaryFile']['filename']); ?>
			</td>
			<td><?php echo h($quicksave['Quicksave']['slot']); ?>
			</td>
			<td><?php echo h($quicksave['User']['username']); ?>
			</td>
			<td><?php echo h($quicksave['Quicksave']['description']); ?>
			</td>
			<td><?php echo $this->Time->format('d/m/Y H:i', $quicksave['Quicksave']['modified']
					, null, $this->Session->read("Auth.User.timezone")); ?>
			</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Download'), array('action' => 'download', $quicksave['Quicksave']['id'])); ?>
				<?php echo $this->Html->link(__('Download Original'), array('admin' => false, 'action' => 'download', $quicksave['Quicksave']['id'], true, true)); ?>
				<?php 
				// Can access owner
			if($this->Session->read('Auth.User.id') == $quicksave['Quicksave']['user_id']):?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $quicksave['Quicksave']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $quicksave['Quicksave']['id']), null, __('Delete Quicksave?')); ?>
				<?php endif; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>

	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
