<div class="row justify-content-center">
    <div id="sortableImages" class="d-flex align-items-center justify-content-center column-gap-3 p-4">
<?php foreach($this->images as $image):?>
    <div class="edit-img-wrapper position-relative" data-id="<?=$image->id?>" id="image_<?= $image->id;?>">
        <img src="<?=PROOT.$image->url; ?>" alt="Картинка">
        <button type="button" class="btn btn-danger btn-sm delete-image-btn position-absolute top-0 end-0" style="z-index:2;" data-id="<?=$image->id?>">&times;</button>
    </div>
<?php endforeach;?>
    </div>
</div>
<script>
function updateSort() {
        let sortedIDs = $("#sortableImages").sortable("toArray");
        $("#images_sorted").val(JSON.stringify(sortedIDs));
}

$(function() {
  $("#sortableImages").sortable({
    axis:"x",
    placeholder: "sortable-placeholder",
    update: function(event, ui) {
      updateSort();
    }
  });

  $(document).on('click', '.delete-image-btn', function() {
    if (confirm('Удалить это изображение?')) {
      var btn = $(this);
      $.ajax({
        url: '<?= PROOT ?>posts/deleteImage',
        method: 'POST',
        data: { image_id: btn.data('id') },
        success: function(resp) {
          if (resp.success) {
            btn.closest('.edit-img-wrapper').remove();
          } else {
            alert(resp.msg || 'Ошибка удаления');
          }
        }
      });
    }
  });
});
</script>