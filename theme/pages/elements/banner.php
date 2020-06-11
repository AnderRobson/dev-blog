<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($counter = 0; $counter < count($banners); $counter++): ?>
            <li data-target="#myCarousel" data-slide-to="<?= $counter; ?>" <?= $counter == 0 ? 'class="active"' : ''; ?>></li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach($banners as $key => $banner): ?>
            <div class="carousel-item <?= $key == 0 ? 'active' : ''; ?>">
                <img src="<?= urlFile('banner/' . $banner->image); ?>" alt="<?= $banner->title ?>" class="img-fluid d-block">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1><?= $banner->title; ?></h1>
                        <p class="lead"><?= $banner->description; ?></p>
                        <p><a class="btn btn-lg btn-primary" href="<?= url("/" . $banner->slug); ?>" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>