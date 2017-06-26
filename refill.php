<?php foreach ($imgs as $img):?>
  <div data-lightbox="gallery" class="flow-offset-1">
      <div class="col-xs-6 col-md-3">
          <a href="<?= url('uploads/gallery/' . $img->getImgSrc()) ?>" data-lightbox="image" title="<?php $img->getDescription() ?>">
              <img src="<?= url('uploads/gallery/' . $img->getImgSrc()) ?>" alt="Image 1"/>
          </a>
      </div>
  </div>
<?php endforeach; ?>
