<!-- banner  -->
<div class="grid wide-full">
    <div class="row no-gutters">
        <div class="col l-12 c-12">
            <div class="slider">
                <div class="slider-item">
                    <a href="" class="slider-item">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1173&q=80" alt="">
                    </a>
                </div>
                <div class="slider-item">
                    <a href="" class="slider-item">
                        <img src="https://images.unsplash.com/photo-1559099078-8ab4ed4eefed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1075&q=80" alt="">
                    </a>
                </div>
                <div class="slider-item">
                    <a href="" class="slider-item">
                        <img src="https://images.unsplash.com/photo-1460627390041-532a28402358?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.slider').slick({
            infinite: true,
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 4000,
            slidesToScroll: 1
        });

        $('.slick-prev').addClass('btn-pre')
        $('.slick-prev').addClass('fa-solid fa-chevron-left')
        $('.slick-prev').text('')

        $('.slick-next').addClass('btn-next')
        $('.slick-next').addClass('fa-solid fa-chevron-right')
        $('.slick-next').text('')
    });
</script>