<div class="row no-gutters rounded flex-md-row m-5 shadow-sm h-md-250 position-relative col-md-3 card">
    <img src="<?=  urlFile('publication/' .  $publication->image);?>" class="card-img-top" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
    <div class="col p-4 d-flex flex-column position-static card-body">
        <strong class="d-inline-block mb-2 text-primary"><?= $publication->title; ?></strong>
        <div class="mb-1 text-muted"><?=  substr($publication->description, 0, 100);?></div>
        <a href="<?=  url($publication->slug);?>" class="stretched-link">Continue reading</a>
    </div>
</div>