<div id="xstore-logo" class="col-md-2">
    <img src="" alt="" />
    <a href="index.php" style="text-decoration:none;"><p>XStore</p></a>
</div>

<div id="form-search" class="col-md-6 col-sm-offset-1">
  <form role="form" class="form-horizontal" method="get" action="results.php" enctype="multipart/multipart/form-data" >
      <div class="form-group">
        <div class="col-sm-9">
          <input type="text" name="user_query" class="form-control" placeholder="Поиск среди тысяч товаров" id="search-field"/>
        </div>
        <button type="submit" class="btn btn-default btn-md" id="find" name="search_now">Найти!</button>
      </div>
    </form>
</div>

<div class="col-md-3" id="wrap-cart">
    <button type="submit" class="btn btn-default btn-lg col-xs-6 right-button" style="margin-left:-3em;">Сравнить</button>
    <a href="customer/cart.php"><button type="submit" class="btn btn-default btn-lg col-xs-6 right-button">Корзина</button></a>
</div>



<style media="screen">
#header {
  position: relativeв;;
}
#xstore-logo {
  height: 4em;
  background-color: gren;
  display: inline-block;
}
#xstore-logo p {
  color: white;
  font-size: 30px;
  margin-top: 0.3em;
  margin-left: 1em;
}
#form-search {
  display: inline-block;
  height: 4.5em;
  background-color: ;
}
#search-field {
  height: 3em;
  margin-top: 0.7em;
}
#find {
  height: 3em;
  margin-top:  0.7em;
}
#wrap-cart {
  display: inline-block;
  height: 4em;
  background-color: ;
}
.right-button {
  margin: 0.4em 0 0 1em;
}
</style>
