<script id="template-article-listing" type="text/x-handlebars-template">
  <a href="/{{ canonical }}" class="row p-4 d-block {{ bgColor }}" data-listing-canonical="{{ canonical }}">
    <div class="col-12">
      <img src="images/articles/{{ image.small }}" alt="Article Image" class="img-fluid mb-2">
    </div><!-- /.col-12 -->
    <div class="col-12">
      {{ title }}
    </div><!-- /.col-12 -->
  </a><!-- /.row -->
</script>
