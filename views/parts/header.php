<header class="row py-4 bg-white">
  <div class="col">
    <h1 class="font-academic my-0"><a href="/">C<small>itizen</small> N<small>ational</small></a></h1>
  </div><!-- /.col -->
  <div class="col-sm-6 col-md-5 col-lg-4 text-right">
    <form action="/">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search" name="keyword" value="<?=Yii::$app->request->get('keyword');?>">
        <span class="input-group-btn">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </span><!-- .input-group-btn -->
      </div><!-- /.input-group -->
    </form>
  </div><!-- /.col -->
</header>
