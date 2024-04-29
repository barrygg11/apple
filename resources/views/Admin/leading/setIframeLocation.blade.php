<script>
    $(function() {
        $('.content-header').html('');
        $('.content-header').css({"padding": "0px"});
        $('.content').css({"padding": "0px"});
        let setHeight = $(window).height() - ($('.main-header').height() + $('.main-footer').innerHeight()) - 2;
        $('#app').height((setHeight.toString() + 'px'));
        $('.content').height((setHeight.toString() + 'px'));
        $('#__Iframe').height((setHeight.toString() + 'px'));
    });
</script>
