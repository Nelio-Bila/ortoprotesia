<template>
  <div class="my-2">
    <div
      id="carouselExampleIndicators"
      class="carousel slide vertical"
      data-ride="carousel"
    >
      <ol class="carousel-indicators">
        <li
          data-target="#carouselExampleIndicators"
          data-slide-to="0"
          class="active"
        ></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div
          class="carousel-item active"
          style="
            background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080');
          "
        >
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">First Slide</h2>
            <p class="lead">This is a description for the first slide.</p>
          </div>
        </div>
        <div
          class="carousel-item"
          style="
            background-image: url('https://source.unsplash.com/bF2vsubyHcQ/1920x1080');
          "
        >
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">Second Slide</h2>
            <p class="lead">This is a description for the second slide.</p>
          </div>
        </div>
        <div
          class="carousel-item"
          style="
            background-image: url('https://source.unsplash.com/szFUQoyvrxM/1920x1080');
          "
        >
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">Third Slide</h2>
            <p class="lead">This is a description for the third slide.</p>
          </div>
        </div>
      </div>
      <a
        class="carousel-control-prev up"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="prev"
      >
        <i class="fas fa-chevron-up fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next down"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="next"
      >
        <i class="fas fa-chevron-down fa-2x" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</template>

<script>
import $ from "jquery";

export default {
  name: "VerticalCarousel",
  mounted: function () {
    $(document).ready(function () {
      $(".carousel").carousel({
        interval: 1000,
      });

      //scroll slides on swipe for touch enabled devices
      $(".carousel").on("touchstart", function (event) {
        var yClick = event.originalEvent.touches[0].pageY;
        $(this).one("touchmove", function (event) {
          var yMove = event.originalEvent.touches[0].pageY;
          if (Math.floor(yClick - yMove) > 1) {
            $(".carousel").carousel("next");
          } else if (Math.floor(yClick - yMove) < -1) {
            $(".carousel").carousel("prev");
          }
        });
        $(".carousel").on("touchend", function () {
          $(this).off("touchmove");
        });
      });
    });
  },
};
</script>

<style scoped>
/* Vertical Slider 100% Height */
.vertical .carousel-item {
  min-height: 250px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

/* Vertical Slider Animation */
.vertical .carousel-item-next.carousel-item-left,
.vertical .carousel-item-prev.carousel-item-right {
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}

.vertical .carousel-item-next,
.vertical .active.carousel-item-right {
  -webkit-transform: translate3d(0, 100%, 0);
  transform: translate3d(0, 100% 0);
}

.vertical .carousel-item-prev,
.vertical .active.carousel-item-left {
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
}

/* Vertical Ccarousel Indicators on Right */
.carousel-indicators {
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  height: 20px;
  right: 10px;
  left: auto;
  width: auto;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}

.carousel-indicators > li {
  display: block;
  border-radius: 12px;
  width: 12px;
  height: 12px;
  border: 0;
}

.carousel-indicators li.active {
  margin-bottom: 5px;
  background: #fff;
}

/* Vertical Carousel Controls on Right */
.carousel.vertical .carousel-control-prev,
.carousel.vertical .carousel-control-next {
  left: auto;
  right: 13.5px;
  width: 50px;
}
.carousel.vertical .carousel-control-prev.up {
  top: 0;
  bottom: 50%;
}
.carousel.vertical .carousel-control-next.down {
  top: 50%;
  bottom: 0;
}
.carousel.vertical .carousel-control-prev.up i,
.carousel.vertical .carousel-control-next.down i {
  position: absolute;
  top: 50%;
  z-index: 5;
  display: inline-block;
  font-size: 2em;
}
.carousel.vertical .carousel-control-prev.up i {
  left: 50%;
  margin-left: -10px;
  top: 50%;
  margin-top: -10px;
}
.carousel.vertical .carousel-control-next.down i {
  left: 50%;
  margin-left: -10px;
  top: 50%;
  margin-top: -10px;
}

/* Vertical Carousel Captions Size */
.carousel-caption {
  max-width: 100%;
  width: 100%;
  height: 85%;
  left: 0;
}
</style>
