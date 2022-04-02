<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Comic</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $comic['sampul']; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comic['judul']; ?></h5>
                            <p class="card-text">
                                <b>Penulis : </b><?= $comic['penulis']; ?>
                            </p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $comic['penerbit']; ?> </small></p>

                            <a href="/comics/edit/<?= $comic['slug']; ?> " class="btn btn-warning">Edit</a>

                            <form action="/comics/delete/<?= $comic['id']; ?> " class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>

                            <br><br>
                            <a href="/comics">Back to comics list</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>