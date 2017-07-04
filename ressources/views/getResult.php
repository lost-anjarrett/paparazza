<?php

$imgsCounted = $galleryImg->getFromTo($_GET['page'], $limit);

$imgs = $imgsCounted['objects'];
//the total of imgs registered
$rowNumber = $imgsCounted['rowNumber'];
//total of pages needed
$numberOfPages = ceil($rowNumber / $limit); ?>

<?php if(isset($imgs)): ?>
  <div class="row" id="gallery">
    <div data-lightbox="gallery" class="flow-offset-1">
      <?php foreach ($imgs as $img):?>
        <div data-lightbox="gallery" class="flow-offset-1">
            <div class="col-xs-6 col-md-3">
                <a href="<?= url('uploads/gallery/' . $img->getImgSrc()) ?>" data-lightbox="image" title="<?php $img->getDescription() ?>">
                    <img src="<?= url('uploads/gallery/' . $img->getImgSrc()) ?>" alt="$img->getDescription()"/>
                </a>
            </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php for($i = 1; $i <= $numberOfPages; $i++): ?>
      <a href="?page=<?= $i ?>"class="btn btn-default" id="<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
  </div>
<?php endif; ?>
