<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<div class="products index content">
    <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('last_updated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    <th><?= $this->Paginator->sort('deleted') ?></th>
                </tr>
            </thead>
            <tbody>
            <div>
                <strong>Filter by status:</strong>
                <?= $this->Html->link(__('All Products'), ['action' => 'index'], ['class' => 'button', 'style' => 'margin-right: 10px;']) ?>
                <?= $this->Html->link(__('In Stock'), ['action' => 'index', '?' => ['status' => 'in stock']], ['class' => 'button', 'style' => 'margin-right: 10px;']) ?>
                <?= $this->Html->link(__('Low Stock'), ['action' => 'index', '?' => ['status' => 'low stock']], ['class' => 'button', 'style' => 'margin-right: 10px;']) ?>
                <?= $this->Html->link(__('Out of Stock'), ['action' => 'index', '?' => ['status' => 'out of stock']], ['class' => 'button']) ?>
            </div>

            <div style="margin-top: 15px;">
                <?= $this->Form->create(null, ['type' => 'get']) ?>
                <?= $this->Form->control('search', [
                    'label' => false,
                    'placeholder' => 'Search by name...',
                    'value' => $searchQuery ?? '',
                    'style' => 'margin-right: 10px;'
                ]) ?>
                <?= $this->Form->button(__('Search')) ?>
                <?= $this->Form->end() ?>
            </div>

                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $this->Number->format($product->id) ?></td>
                    <td><?= h($product->name) ?></td>
                    <td><?= $this->Number->format($product->quantity) ?></td>
                    <td><?= $this->Number->format($product->price) ?></td>
                    <td><?= h($product->status) ?></td>
                    <td><?= ($product->last_updated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                    </td>
                    <td style="<?= $product->deleted ? 'background-color: red; color: white; border-radius: 8px;' : '' ?>">
                        <?= ($product->deleted) ? __('Deleted'): __('')?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
