<script id="template-article-detail" type="text/x-handlebars-template">
  <div class="row" data-view-canonical="{{ canonical }}">
    <div class="col py-3">
      <h2>{{ title }}</h2>

      <img src="images/articles/{{ image.large }}" alt="Article Image" class="w-100 mb-3">

      <img src="images/ad.banner.png" alt="banner ad here" class="img-fluid hidden-lg-up mb-3">

      <div class="article-body">
        <img src="images/ad.medium.rectangle.png" alt="ad space here" class="float-lg-right float-xl-left mb-2 ml-lg-3 mr-lg-0 mr-xl-3 ml-xl-0 hidden-md-down">
        {{ body }}
      </div><!-- /.article-body -->

      <img src="images/ad.banner.png" alt="banner ad here" class="img-fluid hidden-lg-up mb-3">

      <h3 class="heading mb-3 py-2 border-top-0">Comments</h3>

      <div class="card card-block card-inverse card-primary mb-3">
        <div class="row align-items-center">
          <div class="col- col-sm-3 text-center">
            <i class="fa fa-5x fa-facebook"></i>
          </div><!-- /.col-3 -->
          <div class="col">
            Facebook comments widget here
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.card -->
    </div><!-- /.col -->
    <div class="hidden-md-down col-lg-3">
      <div class="ad-block d-block sticky-top text-center">
        <img src="images/ad.medium.rectangle.png" alt="ad space here" class="img-fluid mb-3">
        <img src="images/ad.medium.rectangle.png" alt="ad space here" class="img-fluid mb-3">
      </div><!-- /.d-block sticky-top -->
    </div><!-- /.col-3 -->
  </div><!-- /.row -->
</script>
