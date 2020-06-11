<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach($banners as $key => $banner): ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : ''; ?>">
                <img src="<?= urlFile('banner/' . $banner->image); ?>" alt="<?= $banner->title ?>" class="img-fluid d-block">
            </div>
        <?php endforeach; ?>
    </div>
</div>