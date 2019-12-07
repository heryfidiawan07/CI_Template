
        </div><!-- End Page Content  -->
    </div><!-- Page Wrapper  -->
    <!-- Hery Bootstrap JS CDN -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="<?= base_url().'assets/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <!-- End Hery -->

    <script>
    	$(document).ready(function () {

            var base_url = $('#base_url').val();

            // $(document).on('focus', '#stnk_expired', function() {
            //     $(this).datepicker();
            // });

            $(document).on('click', '#sidebar-btn-collapse', function() {
                $('#sidebar-btn-collapse').toggleClass('active');
                if ($('#sidebar-btn-collapse').hasClass('active')) {
                    // $('.dsh-text').hide();
                    // $('#content').css('padding-left','65px');
                    $('#content').animate({paddingLeft: "-=140px"});
                    $('#sidebar').css('width','60px');
                    $('.dsh-text').fadeOut( "slow");
                    // $('#sidebar-brand').hide();
                    $('#sidebar-brand').attr('src', base_url+'storage/assets/img/icon.png');
                }else {
                    // $('.dsh-text').show();
                    // $('#content').css('padding-left','180px');
                    $('#content').animate({paddingLeft: "+=140px"});
                    $('#sidebar').css('width','200px');
                    $('.dsh-text').fadeIn( "slow");
                    // $('#sidebar-brand').show();
                    $('#sidebar-brand').attr('src', base_url+'assets/img/logo_ilcs_white.png');
                }
            });

            // Count Up ===============================
            $('.total').each(function() {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({ countNum: $this.text()}).animate({
                    countNum: countTo
                },
                {
                    duration: 1000,
                    easing:'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }
                });
            });
        });
    </script>

</body>
</html>
