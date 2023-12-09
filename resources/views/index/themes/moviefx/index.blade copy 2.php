<style>
    .bg-slider {
        position: relative;
        height: 300px;
    }

    .item {
        position: absolute;
        opacity: 0;
        background-size: cover !important;
        background-position: center !important;
        transition: opacity 0.5s ease-in-out;
        max-width: 700px;
    }

    .visible {
        opacity: 1;
    }

    #bg-slider-prev,
    #bg-slider-next {
        font-size: 18px;
        cursor: pointer;
        position: absolute;
        transform: translateY(-50%);


    }

    #bg-slider-controls {
        position: absolute;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        /* İleri ve geri tuşlarını alt alta sırala */
    }

    #bg-slider-prev {
        margin-bottom: 20px;
    }

    #bg-slider-next {
        margin-top: 20px;
    }
</style>

<script src="../../../user/moviefx/assets/js/jquery-3.3.1.min.js"></script>
<script src="../../../user/animex/js/bootstrap.min.js"></script>

<div class="">
    <div>
        <div class="bg-slider" style="max-height: 100px;" style="background-color: red;">
            <a class="item" data-image="../../../user/img/images/gallery_01.jpg"></a>
            <a class="item" data-image="../../../user/img/images/gallery_02.jpg"></a>
            <a class="item" data-image="../../../user/img/images/gallery_03.jpg"></a>

            <div id="bg-slider-controls" style="background-color: blue;">
                <button id="bg-slider-prev">
                    < </button>
                        <button id="bg-slider-next">></button>
            </div>
        </div>

    </div>
</div>




<script>
    var currentImage = 0;
    var totalImage = 0;

    document.addEventListener("DOMContentLoaded", function() {
        var items = document.querySelectorAll('.bg-slider .item');
        totalImage = items.length;

        for (var i = 0; i < items.length; i++) {
            var image = items[i].dataset.image;
            items[i].style.background = 'url(' + image + ') center/cover no-repeat';

            // Resmin boyutlarına göre .item elementlerinin boyutlarını ayarla
            setImageSize(items[i], image);
        }

        showImage(currentImage);

        var nextButton = document.getElementById('bg-slider-next');
        var prevButton = document.getElementById('bg-slider-prev');

        nextButton.addEventListener('click', function() {
            if (currentImage < totalImage - 1) {
                hideImage(currentImage);
                currentImage++;
                showImage(currentImage);
            }
        });

        prevButton.addEventListener('click', function() {
            if (currentImage > 0) {
                hideImage(currentImage);
                currentImage--;
                showImage(currentImage);
            }
        });
    });

    function hideImage(index) {
        var items = document.querySelectorAll('.bg-slider .item');
        items[index].classList.remove('visible');
    }

    function showImage(index) {
        var items = document.querySelectorAll('.bg-slider .item');
        items[index].classList.add('visible');
    }

    function setImageSize(item, imageUrl) {
        var tempImage = new Image();
        tempImage.src = imageUrl;

        tempImage.onload = function() {
            // Resmi sığdırılacak maksimum genişlik
            var maxWidth = 700;

            // Resmin genişliği 700'den büyükse genişliği 700'ye sınırla, yüksekliği oranını koruyarak ayarla
            if (tempImage.width > maxWidth) {
                var aspectRatio = tempImage.height / tempImage.width;
                item.style.width = maxWidth + 'px';
                item.style.height = (maxWidth * aspectRatio) + 'px';
            } else {
                item.style.width = tempImage.width + 'px';
                item.style.height = tempImage.height + 'px';
            }
        };
    }
</script>