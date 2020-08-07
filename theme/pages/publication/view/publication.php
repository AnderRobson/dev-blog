<?php
$v->layout("banner/view/_theme", ["title" => "Publicações"]); ?>

    <?php if (! empty($banners)):
        $v->insert("elements/bannerHeader", ['banners' => $banners]);
    endif; ?>

    <main role="main" class="container">
        <div class="row text-center">
            <?php if (! empty($publications)):
                foreach ($publications as $publication) {
                    $v->insert("elements/publicationCard", ['publication' => $publication]);
                }
            endif; ?>
        </div>
    </main>
<div class="row">
    <div class="col-3">
        <nav id="navBarVertical" class="navbar navbar-light bg-light">
            <nav class="nav nav-pills flex-column">
                <a href="#item1" class="nav-link">Item 1</a>
                <nav class="nav navpills flex-column">
                    <a href="#item1-1" class="nav-link ml-3">Item 1.2</a>
                    <a href="#item1-2" class="nav-link ml-3">Item 1.2</a>
                    <a href="#item1-3" class="nav-link ml-3">Item 1.2</a>
                </nav>
                <a href="#item2 my-2" class="nav-link">Item 2</a>
                <a href="#item3 my-2" class="nav-link">Item 3</a>
                <nav class="nav navpills flex-column">
                    <a href="#item3-1" class="nav-link ml-3">Item 3.2</a>
                    <a href="#item3-2" class="nav-link ml-3">Item 3.2</a>
                    <a href="#item3-3" class="nav-link ml-3">Item 3.2</a>
                </nav>
            </nav>
        </nav>
    </div>
    <div class="col-9">
        <div data-spy="scroll" data-target="navBarVertical" data-offset="0" class="scrollSpayDefault">
            <div class="row" id="item1">
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
                    <h2>Heading</h2>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

        </div>
    </div>
</div>