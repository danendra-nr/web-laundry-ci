<?php $pager->setSurroundCount(2) ?>
<nav class="flex items-center justify-between py-4" aria-label="Pagination">
    <div class="hidden sm:block">
        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">
            Halaman <?= $pager->getCurrentPageNumber() ?> dari <?= $pager->getPageCount() ?>
        </p>
    </div>
    <div class="flex-1 flex justify-between sm:justify-end gap-1.5">
        <?php if ($pager->hasPrevious()) : ?>
            <a href="<?= $pager->getFirst() ?>" class="px-3 py-2 text-xs font-bold border border-gray-200 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all">Awal</a>
            <a href="<?= $pager->getPreviousPage() ?>" class="px-3 py-2 text-xs font-bold border border-gray-200 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all">Sebelumnya</a>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <a href="<?= $link['uri'] ?>" class="px-3 py-2 text-xs font-bold border rounded-xl transition-all <?= $link['active'] ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-100' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' ?>">
                <?= $link['title'] ?>
            </a>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <a href="<?= $pager->getNextPage() ?>" class="px-3 py-2 text-xs font-bold border border-gray-200 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all">Berikutnya</a>
            <a href="<?= $pager->getLast() ?>" class="px-3 py-2 text-xs font-bold border border-gray-200 rounded-xl bg-white text-gray-600 hover:bg-gray-50 transition-all">Akhir</a>
        <?php endif ?>
    </div>
</nav>
