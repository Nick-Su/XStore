
<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav" id="a">
          <li><a href="#" class="active">Категории</a></li>
          <?php getCats(); ?>
        </ul>
        <ul class="nav navbar-nav" id="a">
          <li><a href="#" class="active">Бренды</a></li>
          <?php getBrands() ?>
        </ul>
    </div>
  </div>
</nav>



<style media="screen">

@media (min-width: 768px) {
  .navbar-collapse {
    height: auto;
    border-top: 0;
    box-shadow: none;
    max-height: none;
    padding-left:0;
    padding-right:0;
  }
  .navbar-collapse.collapse {
    display: block !important;
    width: 100%; !important;
    padding-bottom: 0;
    overflow: visible !important;
  }
  .navbar-collapse.in {
    overflow-x: visible;
  }
.navbar
{
  max-width:300px;
  margin-right: 0;
  margin-left: 0;
  background-color: white;
}
.active {
  background-color: #0098E5!important;
  font-size: 18px;
  color: white!important;
}
.active:first-child:hover {
  background-color: #0098E5!important;
}


.navbar {
  border-color: #EDEEF0!important;
}
.navbar-nav,
.navbar-nav > li,
.navbar-left,
.navbar-right,
.navbar-header
{
  float:none !important;
}

ul.nav li a {
  border: 1px solid #DDDDDD!important;
  margin-top: -1px;
}
ul.nav li a:hover {
  background-color: #F4F3F4!important;
}
ul.nav li a:active {

}


</style>
