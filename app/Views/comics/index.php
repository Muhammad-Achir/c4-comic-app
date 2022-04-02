<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/comics/create/" class="btn btn-primary mt-3">Add New Data</a>
            <h1>List Comics</h1>

            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>

            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($comic as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i -= -1 ?></th>
                            <td>
                                <img src="/img/<?= $c['sampul']; ?>" alt="" class="sampul">
                            </td>
                            <td>
                                <?= $c['judul']; ?>
                            </td>
                            <td>
                                <a href="/comics/<?= $c['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>